<?php

namespace Telegram\Bot\Tests\Unit;

use Closure;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use GuzzleHttp\Psr7\Utils;
use Illuminate\Support\Collection;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\StreamInterface;
use Telegram\Bot\Api;
use Telegram\Bot\Contracts\ApiRequestInterface;
use Telegram\Bot\Exceptions\TelegramChatNotFoundException;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\HttpClients\GuzzleHttpClient;
use Telegram\Bot\Objects\EphemeralMessageParameters;
use Telegram\Bot\Objects\InputMediaLivePhoto;
use Telegram\Bot\Objects\InputMediaVideo;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Requests\SendMediaGroupRequest;
use Telegram\Bot\Requests\SendMessageRequest;
use Telegram\Bot\Requests\SendPhotoRequest;
use Telegram\Bot\TelegramRequest;

class RequestSerializationCompatibilityTest extends TestCase
{
    /** @var TelegramRequest|null Request captured before it reaches the transport. */
    private ?TelegramRequest $sentRequest = null;

    public function test_it_preserves_message_request_and_webhook_payloads(): void
    {
        $entities = [['type' => 'bold', 'offset' => 0, 'length' => 2]];
        $markup = ['remove_keyboard' => true];
        $preview = ['is_disabled' => false];
        $reply = ['message_id' => 5, 'quote_rich_texts' => [['type' => 'bold', 'text' => 'Hi']]];
        $request = (new SendMessageRequest(123, 'Hi'))
            ->setEntities($entities)
            ->setLinkPreviewOptions($preview)
            ->setDisableNotification(false)
            ->setReplyParameters($reply)
            ->setReplyMarkup($markup);
        [$api] = $this->createApi(['message_id' => 42]);

        $this->assertSame([
            'method' => 'sendMessage',
            'chat_id' => 123,
            'text' => 'Hi',
            'entities' => $entities,
            'link_preview_options' => $preview,
            'disable_notification' => false,
            'reply_parameters' => $reply,
            'reply_markup' => $markup,
        ], $request->toWebhookPayload());
        $this->assertSame([
            'chat_id' => 123,
            'text' => 'Hi',
            'entities' => json_encode($entities),
            'link_preview_options' => $preview,
            'disable_notification' => false,
            'reply_parameters' => $reply,
            'reply_markup' => json_encode($markup),
        ], $request->toArray());

        $result = $api->sendMessage($request);

        $this->assertInstanceOf(Message::class, $result);
        $this->assertSame(42, $result->getMessageId());
        $this->assertSame(['form_params' => [
            'chat_id' => 123,
            'text' => 'Hi',
            'entities' => json_encode($entities),
            'link_preview_options' => $preview,
            'disable_notification' => false,
            'reply_parameters' => json_encode($reply),
            'reply_markup' => json_encode($markup),
        ]], $this->sentRequest->getOptions());
    }

    public function test_it_preserves_legacy_message_fields_when_passed_as_an_array(): void
    {
        [$api, $transport] = $this->createApi(['message_id' => 42], true);
        $params = [
            '_AccessToken_' => 'override-token',
            'chat_id' => 123,
            'text' => '',
            'parse_mode' => 'HTML',
            'entities' => [['type' => 'bold', 'offset' => 0, 'length' => 2]],
            'ephemeral_message_parameters' => EphemeralMessageParameters::make(9)->withCallbackQueryId(null),
            'reply_parameters' => ['message_id' => 5],
            'reply_markup' => '{"remove_keyboard":true}',
            'extra_parameter' => null,
        ];

        $result = $api->sendMessage($params);

        $this->assertInstanceOf(Closure::class, $result);
        $this->assertInstanceOf(Message::class, $result());
        $this->assertSame('/botoverride-token/sendMessage', $transport->getLastRequest()->getUri()->getPath());
        unset($params['_AccessToken_']);
        $params['ephemeral_message_parameters'] = '{"receiver_user_id":9}';
        $this->assertSame(['form_params' => $params], $this->sentRequest->getOptions());
    }

    public function test_it_keeps_photo_id_and_nested_fields_in_their_existing_formats(): void
    {
        $entities = [['type' => 'bold', 'offset' => 0, 'length' => 2]];
        $request = (new SendPhotoRequest(123, 'photo-id'))->caption('Hi')->captionEntities($entities);
        [$api, $transport] = $this->createApi(['message_id' => 42]);

        $this->assertSame([
            'method' => 'sendPhoto',
            'chat_id' => 123,
            'photo' => 'photo-id',
            'caption' => 'Hi',
            'caption_entities' => $entities,
        ], $request->toWebhookPayload());
        $this->assertSame(json_encode($entities), $request->toRequestParams()['caption_entities']);

        $result = $api->sendPhoto($request);

        $this->assertInstanceOf(Message::class, $result);
        $this->assertSame(42, $result->getMessageId());
        $this->assertStringStartsWith('multipart/form-data;', $transport->getLastRequest()->getHeaderLine('Content-Type'));
        $this->assertSame(['multipart' => [
            ['name' => 'chat_id', 'contents' => 123],
            ['name' => 'photo', 'contents' => 'photo-id'],
            ['name' => 'caption', 'contents' => 'Hi'],
            ['name' => 'caption_entities', 'contents' => json_encode($entities)],
        ]], $this->sentRequest->getOptions());
    }

    public function test_it_preserves_photo_upload_inputs_when_building_multipart_requests(): void
    {
        $fixture = tmpfile();
        $this->assertIsResource($fixture);
        fwrite($fixture, 'This is test!');
        $path = stream_get_meta_data($fixture)['uri'];
        $resource = fopen($path, 'rb');
        $stream = Utils::streamFor('stream contents');

        try {
            foreach ([$path, $resource, $stream, new InputFile($path, 'custom.txt')] as $photo) {
                [$api, $transport] = $this->createApi(['message_id' => 42], true);
                $params = $photo instanceof InputFile
                    ? new SendPhotoRequest(123, $photo)
                    : ['chat_id' => 123, 'photo' => $photo, 'caption' => null];
                $result = $api->sendPhoto($params);

                $this->assertInstanceOf(Closure::class, $result);
                $this->assertInstanceOf(Message::class, $result());
                $parts = $this->sentRequest->getOptions()['multipart'];
                $this->assertSame(['chat_id', 'photo'], array_column($parts, 'name'));
                if (is_string($photo) || $photo instanceof InputFile) {
                    $this->assertInstanceOf(StreamInterface::class, $parts[1]['contents']);
                } else {
                    $this->assertSame($photo, $parts[1]['contents']);
                }

                $body = (string) $transport->getLastRequest()->getBody();
                $this->assertStringContainsString($photo === $stream ? 'stream contents' : 'This is test!', $body);
                if ($photo instanceof InputFile) {
                    $this->assertStringContainsString('filename="custom.txt"', $body);
                }
            }
        } finally {
            if (is_resource($resource)) {
                fclose($resource);
            }
            fclose($fixture);
        }
    }

    public function test_it_preserves_media_group_webhook_and_form_payloads(): void
    {
        $media = [
            ['type' => 'photo', 'media' => 'photo-id'],
            ['type' => 'video', 'media' => 'video-id', 'caption' => 'Hi'],
        ];
        $request = (new SendMediaGroupRequest(123, $media))->disableNotification(false);
        [$api, $transport] = $this->createApi([['message_id' => 42], ['message_id' => 43]]);

        $this->assertSame(['method' => 'sendMediaGroup', 'chat_id' => 123, 'media' => $media, 'disable_notification' => false], $request->toWebhookPayload());
        $this->assertInstanceOf(InputMediaVideo::class, $request->toArray()['media'][1]);

        $result = $api->sendMediaGroup($request);

        $this->assertInstanceOf(Collection::class, $result);
        $this->assertContainsOnlyInstancesOf(Message::class, $result);
        $this->assertSame([42, 43], $result->map(fn (Message $message): int => $message->getMessageId())->all());
        $this->assertSame('application/x-www-form-urlencoded', $transport->getLastRequest()->getHeaderLine('Content-Type'));
        $this->assertSame(['form_params' => [
            'chat_id' => 123,
            'media' => json_encode($media),
            'disable_notification' => false,
        ]], $this->sentRequest->getOptions());
    }

    public function test_it_preserves_media_group_attachment_names_order_and_mutation(): void
    {
        $video = new InputMediaVideo([
            'type' => 'video',
            'media' => Utils::streamFor('video'),
            'thumb' => Utils::streamFor('old thumb'),
            'thumbnail' => Utils::streamFor('thumbnail'),
            'cover' => Utils::streamFor('cover'),
        ]);
        $livePhoto = ['type' => 'live_photo', 'media' => 'video-id', 'photo' => Utils::streamFor('photo')];
        $request = new SendMediaGroupRequest(123, [$video, $livePhoto]);
        [$api] = $this->createApi([['message_id' => 42], ['message_id' => 43]], true);

        $result = $api->sendMediaGroup($request);

        $this->assertInstanceOf(Closure::class, $result);
        $this->assertContainsOnlyInstancesOf(Message::class, $result());
        $parts = $this->sentRequest->getOptions()['multipart'];
        $names = ['__ATTACHED_FILE__0', '__ATTACHED_THUMB__0', '__ATTACHED_THUMBNAIL__0', '__ATTACHED_COVER__0', '__ATTACHED_PHOTO__1'];
        $this->assertSame(['chat_id', 'media', ...$names], array_column($parts, 'name'));
        $expectedMedia = [
            ['type' => 'video', 'media' => 'attach://'.$names[0], 'thumb' => 'attach://'.$names[1], 'thumbnail' => 'attach://'.$names[2], 'cover' => 'attach://'.$names[3]],
            ['type' => 'live_photo', 'media' => 'video-id', 'photo' => 'attach://'.$names[4]],
        ];
        $this->assertSame(json_encode($expectedMedia), $parts[1]['contents']);
        $this->assertSame(['video', 'old thumb', 'thumbnail', 'cover', 'photo'], array_map(
            fn (array $part): string => (string) $part['contents'],
            array_slice($parts, 2),
        ));
        $this->assertSame($expectedMedia[0], $video->toArray());
        $this->assertInstanceOf(InputMediaLivePhoto::class, $request->toArray()['media'][1]);
        $this->assertSame($expectedMedia, $request->toWebhookPayload()['media']);
    }

    public function test_it_preserves_raw_and_preencoded_media_in_legacy_calls(): void
    {
        $media = [2 => ['type' => 'photo', 'media' => 'photo-id', 'caption' => null]];
        foreach ([$media, '{ "2": {"type":"photo","media":"photo-id"} }'] as $input) {
            [$api] = $this->createApi([['message_id' => 42]]);
            $result = $api->sendMediaGroup(['chat_id' => 123, 'media' => $input]);

            $this->assertInstanceOf(Collection::class, $result);
            $this->assertSame(['form_params' => [
                'chat_id' => 123,
                'media' => is_array($input) ? json_encode($input) : $input,
            ]], $this->sentRequest->getOptions());
        }
    }

    /**
     * @param  string  $method  The API wrapper to call.
     * @param  ApiRequestInterface  $request  Invalid typed input.
     * @param  string  $message  The expected validation error.
     *
     * @dataProvider invalidRequests
     */
    public function test_it_rejects_invalid_typed_inputs_before_transport(string $method, ApiRequestInterface $request, string $message): void
    {
        [$api, $transport] = $this->createApi(['message_id' => 42], true);

        try {
            $api->$method($request);
            $this->fail('Expected immediate validation failure.');
        } catch (TelegramValidationException $exception) {
            $this->assertSame($message, $exception->getMessage());
            $this->assertNull($transport->getLastRequest());
        }
    }

    /**
     * @return array<string, array{string, ApiRequestInterface, string}>
     */
    public static function invalidRequests(): array
    {
        return [
            'message' => ['sendMessage', new SendMessageRequest(123, ''), 'Text cannot be empty'],
            'photo' => ['sendPhoto', (new SendPhotoRequest(123, 'photo-id'))->parseMode('HTML')->captionEntities([]), 'parse_mode cannot be used with caption_entities'],
            'album' => ['sendMediaGroup', new SendMediaGroupRequest(123, []), 'Media array must include at least 2 items'],
        ];
    }

    public function test_it_dispatches_through_the_request_subclass_to_array_override(): void
    {
        $request = new class(123, 'Hi') extends SendMessageRequest
        {
            public function toArray(): array
            {
                return parent::toArray() + ['custom' => 'serialized by subclass'];
            }

            public function toRequestParams(): array
            {
                return ['text' => 'Different public representation'];
            }
        };
        [$api] = $this->createApi(['message_id' => 42]);

        $api->sendMessage($request);

        $this->assertSame(['form_params' => [
            'chat_id' => 123,
            'text' => 'Hi',
            'custom' => 'serialized by subclass',
        ]], $this->sentRequest->getOptions());
    }

    public function test_it_propagates_photo_open_errors_before_async_dispatch(): void
    {
        $path = __DIR__.'/../FileUpload/missing-photo.txt';
        $request = new SendPhotoRequest(123, new InputFile($path));
        [$api, $transport] = $this->createApi(['message_id' => 42], true);

        try {
            $api->sendPhoto($request);
            $this->fail('Expected an immediate file open error.');
        } catch (TelegramValidationException $exception) {
            $this->assertSame('Failed to create InputFile entity. Unable to read resource: '.$path.'.', $exception->getMessage());
            $this->assertNull($transport->getLastRequest());
        }
    }

    public function test_it_preserves_telegram_exceptions_and_their_timing(): void
    {
        $paramsByMethod = [
            'sendMessage' => ['chat_id' => 123, 'text' => 'Hi'],
            'sendPhoto' => ['chat_id' => 123, 'photo' => 'photo-id'],
            'sendMediaGroup' => ['chat_id' => 123, 'media' => []],
        ];
        foreach ($paramsByMethod as $method => $params) {
            foreach ([false, true] as $async) {
                [$api] = $this->createApi([], $async, 'Bad Request: chat not found');
                $returned = false;
                try {
                    $result = $api->$method($params);
                    $returned = true;
                    $this->assertInstanceOf(Closure::class, $result);
                    $result();
                    $this->fail('Expected a Telegram API exception.');
                } catch (TelegramChatNotFoundException $exception) {
                    $this->assertSame($async, $returned);
                    $this->assertSame(400, $exception->getCode());
                    $this->assertSame('Bad Request: chat not found', $exception->getMessage());
                }
            }
        }
    }

    /**
     * @param  array  $result  Successful response data.
     * @param  bool  $async  Whether the SDK defers response parsing.
     * @param  string|null  $error  Telegram error description, if any.
     * @return array{Api, MockHandler}
     *
     * @throws \Telegram\Bot\Exceptions\TelegramSDKException
     */
    private function createApi(array $result, bool $async = false, ?string $error = null): array
    {
        $body = $error === null
            ? ['ok' => true, 'result' => $result]
            : ['ok' => false, 'error_code' => 400, 'description' => $error];
        $transport = new MockHandler([new Response($error === null ? 200 : 400, [], json_encode($body))]);
        $client = new Client(['handler' => HandlerStack::create($transport)]);

        $api = new Api('mock-token', $async, new GuzzleHttpClient($client));
        $api->onSending(function (TelegramRequest $request): void {
            $this->sentRequest = $request;
        });

        return [$api, $transport];
    }
}
