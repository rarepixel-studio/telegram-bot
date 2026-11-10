<?php

namespace Telegram\Bot\Tests\Unit;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\FulfilledPromise;
use GuzzleHttp\Promise\RejectedPromise;
use GuzzleHttp\Psr7\Request;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramResponseException;
use Telegram\Bot\TelegramRequest;
use Telegram\Bot\TelegramResponse;

class TelegramResponseTest extends TestCase
{
    /**
     * Verify repeated waits preserve the response-less failure and its context.
     */
    public function test_it_preserves_original_error_when_waiting_without_an_http_response(): void
    {
        $exception = new RequestException(
            'Connection reset',
            new Request('POST', 'https://api.telegram.org'),
            null,
            new \RuntimeException('Socket closed'),
            ['errno' => 56]
        );
        $response = new TelegramResponse($this->createRequest(), new RejectedPromise($exception));

        for ($attempt = 0; $attempt < 2; $attempt++) {
            try {
                $response->wait()->throwException();
                $this->fail('Expected the original request exception.');
            } catch (RequestException $caught) {
                $this->assertSame($exception, $caught);
                $this->assertSame($exception, $response->getRequestException());
            }
        }
    }

    /**
     * Verify HTTP errors still expose the Telegram error and original exception.
     *
     * @throws RequestException
     */
    public function test_it_preserves_http_error_details_when_a_response_is_available(): void
    {
        $httpResponse = new Response(400, [], '{"ok":false,"error_code":400,"description":"Invalid request"}');
        $exception = new RequestException('HTTP error', new Request('POST', 'https://api.telegram.org'), $httpResponse);
        $response = new TelegramResponse($this->createRequest(), new RejectedPromise($exception));

        $this->assertSame($response, $response->wait());
        $this->assertTrue($response->ready());
        $this->assertSame(400, $response->getHttpStatusCode());

        try {
            $response->throwException();
            $this->fail('Expected a Telegram response exception.');
        } catch (TelegramResponseException $caught) {
            $this->assertSame('Invalid request', $caught->getMessage());
            $this->assertSame($exception, $caught->getPrevious());
        }
    }

    /**
     * Verify successful responses can still be waited on repeatedly.
     *
     * @throws RequestException
     * @throws TelegramResponseException
     */
    public function test_it_returns_result_when_the_request_succeeds(): void
    {
        $response = new TelegramResponse(
            $this->createRequest(),
            new FulfilledPromise(new Response(200, [], '{"ok":true,"result":true}'))
        );

        $this->assertSame($response, $response->wait()->wait()->throwException());
        $this->assertTrue($response->getResult());
        $this->assertNull($response->getRequestException());
    }

    private function createRequest(): TelegramRequest
    {
        return new TelegramRequest('token', 'sendMessage', [], [], false, 60, 10);
    }
}
