<?php

namespace Telegram\Bot\Tests\Unit;

use Closure;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use PHPUnit\Framework\TestCase;
use Telegram\Bot\Api;
use Telegram\Bot\HttpClients\GuzzleHttpClient;
use Telegram\Bot\Objects\ChatShareThemeBackdrops;
use Telegram\Bot\Objects\InlineQuery\InlineQueryResultArticle;
use Telegram\Bot\Objects\InputContent\InputSharedWidgetMessageContent;
use Telegram\Bot\Objects\InputContent\InputWidgetMessageContent;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\ReplyParameters;
use Telegram\Bot\Objects\UniqueGift;
use Telegram\Bot\Requests\AnswerWidgetQueryRequest;
use Telegram\Bot\Requests\DeleteBusinessAccountGiftRequest;
use Telegram\Bot\Requests\EditMessageWidgetDataRequest;
use Telegram\Bot\Requests\EditSharedWidgetDataRequest;
use Telegram\Bot\Requests\GetChatShareThemeBackdropsRequest;
use Telegram\Bot\Requests\GetUniqueGiftRequest;
use Telegram\Bot\Requests\SendMessageRequest;
use Telegram\Bot\Requests\SendSharedWidgetRequest;
use Telegram\Bot\Requests\SendWidgetRequest;
use Telegram\Bot\Requests\TelegramApiRequest;

class BotApi104MethodsTest extends TestCase
{
    /**
     * @dataProvider widgetAndGiftMethods
     */
    public function test_it_dispatches_each_new_method_using_arrays_requests_and_async_calls(
        TelegramApiRequest $request,
        array $expectedParams,
        array|bool $response,
        ?string $resultClass,
    ): void {
        $method = $request->getMethod();

        foreach (['array', 'request', 'async'] as $mode) {
            [$api, $transport] = $this->createApi($response, $mode === 'async');

            $result = match ($mode) {
                'array' => $api->{$method}($expectedParams),
                'request' => $api->{$method}($request),
                'async' => $api->handleRequest($request),
            };

            if ($mode === 'async') {
                $this->assertInstanceOf(Closure::class, $result);
                $result = $result();
            }

            if ($resultClass === null) {
                $this->assertTrue($result);
            } else {
                $this->assertInstanceOf($resultClass, $result);
                $this->assertSame($response, json_decode($result->toJson(), true));
            }

            $httpRequest = $transport->getLastRequest();
            $this->assertStringEndsWith('/'.$method, $httpRequest->getUri()->getPath());
            parse_str((string) $httpRequest->getBody(), $sentParams);
            $this->assertEquals($expectedParams, $sentParams);
        }
    }

    /**
     * @return array<string, array{TelegramApiRequest, array, array|bool, class-string|null}>
     */
    public static function widgetAndGiftMethods(): array
    {
        $widget = ['message_id' => 42, 'widget' => ['id' => 'widget-id', 'html' => '<b>Hi</b>']];
        $backdrops = ['backdrops' => [['id' => 2, 'name' => 'Blue', 'colors' => [
            'center_color' => 123, 'edge_color' => 456, 'symbol_color' => 789, 'text_color' => 1234,
        ]]]];
        $gift = ['name' => 'Gift-1'];

        return [
            'sendWidget' => [new SendWidgetRequest(123, '<b>Hi</b>'), ['chat_id' => 123, 'html' => '<b>Hi</b>'], $widget, Message::class],
            'sendSharedWidget' => [new SendSharedWidgetRequest(123, 'widget-id'), ['chat_id' => 123, 'widget_id' => 'widget-id'], $widget, Message::class],
            'answerWidgetQuery' => [(new AnswerWidgetQueryRequest('query-id'))->data('answer'), ['widget_query_id' => 'query-id', 'data' => 'answer'], true, null],
            'editMessageWidgetData' => [(new EditMessageWidgetDataRequest)->inlineMessageId('inline-id')->chatData(''), ['inline_message_id' => 'inline-id', 'chat_data' => ''], true, null],
            'editSharedWidgetData' => [new EditSharedWidgetDataRequest('widget-id', ''), ['widget_id' => 'widget-id', 'public_data' => ''], true, null],
            'getChatShareThemeBackdrops' => [new GetChatShareThemeBackdropsRequest, [], $backdrops, ChatShareThemeBackdrops::class],
            'getUniqueGift' => [new GetUniqueGiftRequest('Gift-1'), ['name' => 'Gift-1'], $gift, UniqueGift::class],
            'deleteBusinessAccountGift' => [new DeleteBusinessAccountGiftRequest('business-id', 'gift-id'), ['business_connection_id' => 'business-id', 'owned_gift_id' => 'gift-id'], true, null],
        ];
    }

    public function test_it_serializes_new_nested_parameters_for_direct_api_calls(): void
    {
        [$api, $transport] = $this->createApi(['message_id' => 42]);
        $api->sendMessage([
            'text' => 'Ephemeral reply',
            'ephemeral_message_parameters' => ['callback_query_id' => 'callback-id', 'receiver_user_id' => null],
        ]);

        parse_str((string) $transport->getLastRequest()->getBody(), $payload);
        $this->assertArrayNotHasKey('chat_id', $payload);
        $this->assertSame('{"callback_query_id":"callback-id"}', $payload['ephemeral_message_parameters']);

        [$api, $transport] = $this->createApi(['message_id' => 43]);
        $quote = ['Quoted ', ['type' => 'bold', 'text' => 'text']];
        $api->sendMessage((new SendMessageRequest(123, 'Reply'))->setReplyParameters(
            ReplyParameters::make(42)->withQuoteRichTexts($quote)
        ));

        parse_str((string) $transport->getLastRequest()->getBody(), $payload);
        $this->assertSame(['message_id' => 42, 'quote_rich_texts' => $quote], json_decode($payload['reply_parameters'], true));

        [$api, $transport] = $this->createApi(true);
        $entities = [['type' => 'text_link', 'offset' => 0, 'length' => 4, 'url' => 'https://example.com']];
        $this->assertTrue($api->verifyChat([
            'chat_id' => '@channel',
            'custom_description' => 'Link',
            'custom_description_entities' => $entities,
        ]));
        parse_str((string) $transport->getLastRequest()->getBody(), $payload);
        $this->assertSame($entities, json_decode($payload['custom_description_entities'], true));
    }

    public function test_it_serializes_widget_inline_content_in_query_results(): void
    {
        [$api, $transport] = $this->createApi(true);
        $widget = new InputWidgetMessageContent(['html' => '<b>Hi</b>', 'is_shared' => true]);
        $sharedWidget = new InputSharedWidgetMessageContent(['widget_id' => 'widget-id', 'chat_data' => '']);
        $api->answerInlineQuery([
            'inline_query_id' => 'query-id',
            'results' => [
                new InlineQueryResultArticle(['id' => '1', 'title' => 'New', 'input_message_content' => $widget]),
                new InlineQueryResultArticle(['id' => '2', 'title' => 'Shared', 'input_message_content' => $sharedWidget]),
            ],
        ]);

        parse_str((string) $transport->getLastRequest()->getBody(), $payload);
        $results = json_decode($payload['results'], true);
        $this->assertSame($widget->toArray(), $results[0]['input_message_content']);
        $this->assertSame($sharedWidget->toArray(), $results[1]['input_message_content']);
    }

    /**
     * @param  array<string, mixed>|bool  $result  Mock Telegram result
     * @param  bool  $async  Whether the SDK should defer result parsing
     * @return array{Api, MockHandler}
     */
    private function createApi(array|bool $result, bool $async = false): array
    {
        $transport = new MockHandler([new Response(200, [], json_encode(['ok' => true, 'result' => $result]))]);
        $client = new Client(['handler' => HandlerStack::create($transport)]);

        return [new Api('123456:mock-token', $async, new GuzzleHttpClient($client)), $transport];
    }
}
