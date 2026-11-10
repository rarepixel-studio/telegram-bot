<?php

namespace Telegram\Bot\Tests\Unit;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\TransferException;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Telegram\Bot\Api;
use Telegram\Bot\HttpClients\GuzzleHttpClient;

class ApiTransportFailureTest extends TestCase
{
    /**
     * Verify both request modes propagate the exact transport failure.
     *
     * @param  class-string<TransferException>  $exceptionClass  The transport failure type.
     * @param  bool  $async  Whether to retrieve the result through an async callback.
     *
     * @dataProvider transportFailures
     */
    public function test_it_preserves_original_error_when_request_has_no_http_response(string $exceptionClass, bool $async): void
    {
        $exception = new $exceptionClass('Transport failed', new Request('POST', 'https://api.telegram.org'));
        $api = $this->createApi([$exception], $async);

        try {
            $result = $api->sendMessage(['chat_id' => 123, 'text' => 'Hello']);
            $this->assertInstanceOf(\Closure::class, $result);
            $result();
            $this->fail('Expected the original transport exception.');
        } catch (TransferException $caught) {
            $this->assertSame($exception, $caught);
        } finally {
            $api->setAsyncRequest(false);
        }
    }

    /**
     * Verify async cleanup drains failed and successful requests without masking errors.
     */
    public function test_it_drains_pending_requests_when_a_request_has_no_http_response(): void
    {
        $exception = new RequestException('Transport failed', new Request('POST', 'https://api.telegram.org'));
        $api = $this->createApi([
            $exception,
            new Response(200, [], '{"ok":true,"result":{"message_id":42}}'),
        ], true);
        $failed = $api->sendMessage(['chat_id' => 123, 'text' => 'First']);
        $succeeded = $api->sendMessage(['chat_id' => 123, 'text' => 'Second']);

        $this->assertSame($api, $api->setAsyncRequest(false));
        $this->assertFalse($api->isAsyncRequest());
        $this->assertSame([], $api->asyncWait());
        $this->assertSame(42, $succeeded()->getMessageId());

        try {
            $failed();
            $this->fail('Expected the original request exception after cleanup.');
        } catch (RequestException $caught) {
            $this->assertSame($exception, $caught);
        }
    }

    /**
     * Provide response-less transport failures in both request modes.
     *
     * @return array<string, array{class-string<TransferException>, bool}>
     */
    public static function transportFailures(): array
    {
        return [
            'sync request failure' => [RequestException::class, false],
            'async request failure' => [RequestException::class, true],
            'sync connection failure' => [ConnectException::class, false],
            'async connection failure' => [ConnectException::class, true],
        ];
    }

    /**
     * @param  array<TransferException|Response>  $responses  Mock HTTP outcomes.
     * @param  bool  $async  Whether requests run asynchronously.
     * @return Api The SDK with a mocked HTTP transport.
     */
    private function createApi(array $responses, bool $async): Api
    {
        $handler = HandlerStack::create(new MockHandler($responses));

        return new Api('token', $async, new GuzzleHttpClient(new Client(['handler' => $handler])));
    }
}
