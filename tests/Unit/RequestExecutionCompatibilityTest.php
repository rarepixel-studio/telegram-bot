<?php

namespace Telegram\Bot\Tests\Unit;

use Closure;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;
use Telegram\Bot\Api;
use Telegram\Bot\Contracts\ApiRequestInterface;
use Telegram\Bot\Exceptions\TelegramChatNotFoundException;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\HttpClients\GuzzleHttpClient;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Requests\DeleteMessagesRequest;
use Telegram\Bot\Requests\GetUserPersonalChatMessagesRequest;
use Telegram\Bot\Requests\SendContactRequest;
use Telegram\Bot\Requests\SendLocationRequest;
use Telegram\Bot\Requests\SendMessageRequest;
use Telegram\Bot\Requests\SendPaidMediaRequest;
use Telegram\Bot\Requests\SendVenueRequest;
use Telegram\Bot\TelegramRequest;
use Telegram\Bot\TelegramResponse;

class RequestExecutionCompatibilityTest extends TestCase
{
    /**
     * @param  string  $method  SDK entry point returning one message.
     * @param  array<string, mixed>|ApiRequestInterface  $input  Parameters accepted by the entry point.
     *
     * @dataProvider messageParserCalls
     */
    public function test_it_unwraps_the_response_once_when_reading_a_message(string $method, array|ApiRequestInterface $input): void
    {
        $message = ['message_id' => 42, 'result' => ['custom' => 'preserved']];
        foreach ([false, true] as $async) {
            $api = $this->createApi($async, ['ok' => true, 'result' => $message]);
            $actual = $api->$method($input);
            if ($async) {
                $this->assertInstanceOf(Closure::class, $actual);
                $actual = $actual();
            }

            $this->assertInstanceOf(Message::class, $actual);
            $this->assertSame($message, $actual->all());
        }
    }

    /**
     * @return iterable<string, array{string, array<string, mixed>|ApiRequestInterface}>
     */
    public static function messageParserCalls(): iterable
    {
        foreach (['sendMessage', 'sendRichMessage', 'forwardMessage', 'sendLocation', 'sendVenue', 'sendContact',
            'sendPoll', 'sendChecklist', 'editMessageCaption', 'editMessageReplyMarkup'] as $method) {
            yield $method => [$method, []];
        }

        $paidMedia = new SendPaidMediaRequest(123, 1, [['type' => 'photo', 'media' => 'photo-id']]);
        yield 'paid media wrapper' => ['sendPaidMedia', $paidMedia];
        yield 'paid media via handleRequest' => ['handleRequest', $paidMedia];
        yield 'default upload parser' => ['sendPhoto', ['chat_id' => 123, 'photo' => 'photo-id']];
    }

    /**
     * @param  string  $method  Wrapper under test.
     * @param  array<string, mixed>|ApiRequestInterface  $input  Legacy or typed input.
     * @param  array<string, mixed>  $payload  Expected parameters at both dispatch hooks.
     * @param  array<mixed>|bool  $result  Telegram result fixture.
     * @param  bool  $async  Whether the wrapper defers response resolution.
     *
     * @dataProvider successfulRequests
     */
    public function test_it_preserves_dispatch_hooks_callbacks_and_results(
        string $method,
        array|ApiRequestInterface $input,
        array $payload,
        array|bool $result,
        bool $async,
    ): void {
        $api = $this->createApi($async, ['ok' => true, 'result' => $result]);
        $events = [];
        $api->onSending(function (TelegramRequest $request) use (&$events): void {
            $events[] = ['sending', $request->getEndpoint(), $request->getOptions()];
        })->onFulfilled(function (TelegramResponse $response, float $elapsed) use (&$events): void {
            $events[] = ['fulfilled', $response];
        })->onRejected(function () use (&$events): void {
            $events[] = ['rejected'];
        });

        $actual = $api->$method($input);

        $this->assertSame([[$method, $payload]], $api->postCalls);
        $this->assertCount(1, $api->preparedResponses);
        $response = $api->preparedResponses[0];
        $this->assertSame($api->postedResponse, $response);
        $this->assertSame($api->preparedResult, $actual);
        $sending = ['sending', $method, ['form_params' => $payload]];
        if ($async) {
            $this->assertSame([$sending], $events);
            $this->assertInstanceOf(Closure::class, $actual);
            $actual = $actual();
        }

        $this->assertSame([$sending, ['fulfilled', $response]], $events);
        $this->assertSame($async ? [$response] : [], $api->asyncWait());
        if (in_array($method, ['sendMessage', 'sendLocation', 'sendVenue', 'sendContact'], true)) {
            $this->assertInstanceOf(Message::class, $actual);
            $this->assertSame($result['message_id'], $actual->getMessageId());
            $this->assertSame($result, json_decode($actual->toJson(), true));
        } elseif ($method === 'getUserPersonalChatMessages') {
            $this->assertInstanceOf(Collection::class, $actual);
            $this->assertContainsOnlyInstancesOf(Message::class, $actual);
            $this->assertSame(array_column($result, 'message_id'), $actual->map(
                fn (Message $message): int => $message->getMessageId(),
            )->all());
        } else {
            $this->assertSame($result, $actual);
        }
    }

    /**
     * @return iterable<string, array{string, array<string, mixed>|ApiRequestInterface, array<string, mixed>, array<mixed>|bool, bool}>
     */
    public static function successfulRequests(): iterable
    {
        foreach ([false, true] as $async) {
            $mode = $async ? 'async' : 'sync';
            $legacyMessage = ['text' => '', 'disable_notification' => false, 'extra' => null];
            $legacyDelete = ['message_ids' => []];
            $legacyHistory = ['user_id' => 17, 'limit' => 0];
            $history = [['message_id' => 42], ['message_id' => 9]];

            yield "$mode legacy message" => ['sendMessage', $legacyMessage, $legacyMessage, ['message_id' => 42], $async];
            yield "$mode typed message" => ['sendMessage', new SendMessageRequest(123, 'Hello'), ['chat_id' => 123, 'text' => 'Hello'], ['message_id' => 42], $async];
            yield "$mode legacy deletion" => ['deleteMessages', $legacyDelete, $legacyDelete, false, $async];
            yield "$mode typed deletion" => ['deleteMessages', new DeleteMessagesRequest(123, [4, 5]), ['chat_id' => 123, 'message_ids' => '[4,5]'], true, $async];
            yield "$mode legacy history" => ['getUserPersonalChatMessages', $legacyHistory, $legacyHistory, [], $async];
            yield "$mode typed history" => ['getUserPersonalChatMessages', new GetUserPersonalChatMessagesRequest(17, 2), ['user_id' => 17, 'limit' => 2], $history, $async];

            $location = ['latitude' => 40.7128, 'longitude' => -74.006];
            $venue = ['location' => $location, 'title' => 'Central Park', 'address' => 'New York, NY'];
            $contact = ['phone_number' => '+12025550123', 'first_name' => 'Alex'];
            $replyMarkup = ['force_reply' => true];
            $legacyOptions = ['disable_notification' => false, 'reply_markup' => $replyMarkup, 'extra' => null];
            $typedOptions = ['disable_notification' => false, 'reply_markup' => '{"force_reply":true}'];

            $legacyLocation = ['latitude' => 91.0, 'longitude' => 0.0] + $legacyOptions;
            $typedLocation = (new SendLocationRequest(123, 40.7128, -74.006))
                ->disableNotification(false)
                ->replyMarkup($replyMarkup);
            $locationResult = ['message_id' => 43, 'location' => $location];
            yield "$mode legacy location" => ['sendLocation', $legacyLocation, $legacyLocation, $locationResult, $async];
            yield "$mode typed location" => [
                'sendLocation', $typedLocation, ['chat_id' => 123] + $location + $typedOptions, $locationResult, $async,
            ];

            $legacyVenue = $location + ['title' => '', 'address' => 'New York, NY'] + $legacyOptions;
            $typedVenue = (new SendVenueRequest(123, 40.7128, -74.006, 'Central Park', 'New York, NY'))
                ->disableNotification(false)
                ->replyMarkup($replyMarkup);
            $venueResult = ['message_id' => 44, 'venue' => $venue];
            yield "$mode legacy venue" => ['sendVenue', $legacyVenue, $legacyVenue, $venueResult, $async];
            yield "$mode typed venue" => [
                'sendVenue',
                $typedVenue,
                ['chat_id' => 123] + $location + ['title' => 'Central Park', 'address' => 'New York, NY'] + $typedOptions,
                $venueResult,
                $async,
            ];

            $legacyContact = ['phone_number' => '+12025550123', 'first_name' => ''] + $legacyOptions;
            $typedContact = (new SendContactRequest(123, '+12025550123', 'Alex'))
                ->disableNotification(false)
                ->replyMarkup($replyMarkup);
            $contactResult = ['message_id' => 45, 'contact' => $contact];
            yield "$mode legacy contact" => ['sendContact', $legacyContact, $legacyContact, $contactResult, $async];
            yield "$mode typed contact" => [
                'sendContact', $typedContact, ['chat_id' => 123] + $contact + $typedOptions, $contactResult, $async,
            ];
        }
    }

    /**
     * @param  string  $method  Wrapper under test.
     * @param  ApiRequestInterface  $input  Invalid typed input.
     * @param  string  $message  Expected validation message.
     * @param  bool  $async  Whether the SDK would defer response resolution.
     *
     * @dataProvider invalidTypedRequests
     */
    public function test_it_rejects_invalid_typed_requests_before_dispatch(
        string $method,
        ApiRequestInterface $input,
        string $message,
        bool $async,
    ): void {
        $api = $this->createApi($async, ['ok' => true, 'result' => true]);

        try {
            $api->$method($input);
            $this->fail('Expected validation to fail during the wrapper call.');
        } catch (TelegramValidationException $exception) {
            $this->assertSame($message, $exception->getMessage());
            $this->assertSame([], $api->postCalls);
            $this->assertSame([], $api->preparedResponses);
            $this->assertSame([], $api->asyncWait());
        }
    }

    /**
     * @return iterable<string, array{string, ApiRequestInterface, string, bool}>
     */
    public static function invalidTypedRequests(): iterable
    {
        foreach ([false, true] as $async) {
            $mode = $async ? 'async' : 'sync';

            yield "$mode message" => ['sendMessage', new SendMessageRequest(123, ''), 'Text cannot be empty', $async];
            yield "$mode deletion" => ['deleteMessages', new DeleteMessagesRequest(123, []), 'message_ids cannot be empty', $async];
            yield "$mode history" => ['getUserPersonalChatMessages', new GetUserPersonalChatMessagesRequest(17, 0), 'limit must be between 1 and 20', $async];
            yield "$mode location" => ['sendLocation', new SendLocationRequest(123, 91.0, 0.0), 'Latitude must be between -90 and 90', $async];
            yield "$mode venue" => ['sendVenue', new SendVenueRequest(123, 40.7128, -74.006, '', 'New York, NY'), 'Title cannot be empty', $async];
            yield "$mode contact" => ['sendContact', new SendContactRequest(123, '+12025550123', ''), 'First name cannot be empty', $async];
        }
    }

    public function test_it_preserves_telegram_errors_and_rejection_callbacks_at_response_resolution(): void
    {
        $methods = ['sendMessage', 'deleteMessages', 'getUserPersonalChatMessages', 'sendLocation', 'sendVenue', 'sendContact'];
        foreach ($methods as $method) {
            foreach ([false, true] as $async) {
                $description = 'Bad Request: chat not found';
                $api = $this->createApi($async, ['ok' => false, 'error_code' => 400, 'description' => $description], 400);
                $events = [];
                $api->onSending(function () use (&$events): void {
                    $events[] = ['sending'];
                })->onFulfilled(function () use (&$events): void {
                    $events[] = ['fulfilled'];
                })->onRejected(function (TelegramResponse $response, float $elapsed) use (&$events): void {
                    $events[] = ['rejected', $response];
                });

                $returned = false;
                try {
                    $resolve = $api->$method([]);
                    $returned = true;
                    $this->assertInstanceOf(Closure::class, $resolve);
                    $this->assertSame([['sending']], $events);
                    $resolve();
                    $this->fail('Expected a Telegram API exception.');
                } catch (TelegramChatNotFoundException $exception) {
                    $this->assertSame($async, $returned);
                    $this->assertSame(400, $exception->getCode());
                    $this->assertSame($description, $exception->getMessage());
                    $this->assertCount(1, $api->preparedResponses);
                    $this->assertSame([['sending'], ['rejected', $api->preparedResponses[0]]], $events);
                    $this->assertSame($async ? $api->preparedResponses : [], $api->asyncWait());
                }
            }
        }
    }

    /**
     * @param  bool  $async  Whether the SDK returns a response closure.
     * @param  array<string, mixed>  $body  Mock Telegram response.
     * @param  int  $status  Mock HTTP status code.
     * @return Api The SDK with recorded subclass hooks and a mocked transport.
     *
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    private function createApi(bool $async, array $body, int $status = 200): Api
    {
        $handler = HandlerStack::create(new MockHandler([new Response($status, [], json_encode($body))]));
        $transport = new GuzzleHttpClient(new Client(['handler' => $handler]));

        return new class('mock-token', $async, $transport) extends Api
        {
            /** @var list<array> Arguments received by post(). */
            public array $postCalls = [];

            /** @var TelegramResponse|null Response returned by post(). */
            public ?TelegramResponse $postedResponse = null;

            /** @var list<TelegramResponse> Responses received by prepareResponse(). */
            public array $preparedResponses = [];

            /** @var mixed The value or async closure returned by prepareResponse(). */
            public mixed $preparedResult = null;

            /** {@inheritdoc} */
            protected function post(string $endpoint, array $params = [], array $files = [], array $attachments = []): TelegramResponse
            {
                $this->postCalls[] = func_get_args();

                return $this->postedResponse = parent::post($endpoint, $params, $files, $attachments);
            }

            /** {@inheritdoc} */
            protected function prepareResponse(Closure $parser, TelegramResponse $response): mixed
            {
                $this->preparedResponses[] = $response;

                return $this->preparedResult = parent::prepareResponse($parser, $response);
            }
        };
    }
}
