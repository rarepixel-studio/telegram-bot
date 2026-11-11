<?php

namespace Telegram\Bot\Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Enums\ParseMode;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\EphemeralMessageParameters;
use Telegram\Bot\Objects\MessageEntity;
use Telegram\Bot\Objects\ReplyParameters;
use Telegram\Bot\Requests\AnswerWidgetQueryRequest;
use Telegram\Bot\Requests\EditMessageWidgetDataRequest;
use Telegram\Bot\Requests\EditSharedWidgetDataRequest;
use Telegram\Bot\Requests\SendAnimationRequest;
use Telegram\Bot\Requests\SendAudioRequest;
use Telegram\Bot\Requests\SendContactRequest;
use Telegram\Bot\Requests\SendDocumentRequest;
use Telegram\Bot\Requests\SendLivePhotoRequest;
use Telegram\Bot\Requests\SendLocationRequest;
use Telegram\Bot\Requests\SendMessageRequest;
use Telegram\Bot\Requests\SendPhotoRequest;
use Telegram\Bot\Requests\SendRichMessageRequest;
use Telegram\Bot\Requests\SendSharedWidgetRequest;
use Telegram\Bot\Requests\SendStickerRequest;
use Telegram\Bot\Requests\SendVenueRequest;
use Telegram\Bot\Requests\SendVideoNoteRequest;
use Telegram\Bot\Requests\SendVideoRequest;
use Telegram\Bot\Requests\SendVoiceRequest;
use Telegram\Bot\Requests\SendWidgetRequest;
use Telegram\Bot\Requests\TelegramApiRequest;
use Telegram\Bot\Requests\VerifyChatRequest;
use Telegram\Bot\Requests\VerifyUserRequest;

class BotApi104RequestTest extends TestCase
{
    /**
     * @dataProvider ephemeralSendRequests
     */
    public function test_it_serializes_callback_only_ephemeral_replies_without_a_chat(TelegramApiRequest $request): void
    {
        $request->callbackQueryId('callback-id');
        $request->validate();

        $this->assertArrayNotHasKey('chat_id', $request->toArray());
        $this->assertSame('{"callback_query_id":"callback-id"}', $request->toArray()['ephemeral_message_parameters']);
        $this->assertSame(['callback_query_id' => 'callback-id'], $request->toWebhookPayload()['ephemeral_message_parameters']);
    }

    /**
     * @return array<string, array{TelegramApiRequest}>
     */
    public static function ephemeralSendRequests(): array
    {
        return [
            'SendMessage' => [new SendMessageRequest(null, 'Hello')],
            'SendRichMessage' => [new SendRichMessageRequest(null, ['html' => '<b>Hello</b>'])],
            'SendAnimation' => [new SendAnimationRequest(null, 'file-id')],
            'SendAudio' => [new SendAudioRequest(null, 'file-id')],
            'SendContact' => [new SendContactRequest(null, '+123456', 'Alex')],
            'SendDocument' => [new SendDocumentRequest(null, 'file-id')],
            'SendLivePhoto' => [new SendLivePhotoRequest(null, 'video-id', 'photo-id')],
            'SendLocation' => [new SendLocationRequest(null, 51.5, -0.12)],
            'SendPhoto' => [new SendPhotoRequest(null, 'file-id')],
            'SendSticker' => [new SendStickerRequest(null, 'file-id')],
            'SendVenue' => [new SendVenueRequest(null, 51.5, -0.12, 'Office', 'London')],
            'SendVideo' => [new SendVideoRequest(null, 'file-id')],
            'SendVideoNote' => [new SendVideoNoteRequest(null, 'file-id')],
            'SendVoice' => [new SendVoiceRequest(null, 'file-id')],
        ];
    }

    public function test_it_requires_a_chat_when_the_receiver_is_explicit(): void
    {
        $request = (new SendMessageRequest(null, 'Hello'))
            ->setEphemeralMessageParameters(EphemeralMessageParameters::make(20)->withCallbackQueryId('callback-id'));

        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('chat_id is required');

        $request->validate();
    }

    public function test_it_requires_a_chat_for_a_regular_message(): void
    {
        $this->expectException(TelegramValidationException::class);

        (new SendPhotoRequest(null, 'file-id'))->validate();
    }

    public function test_it_omits_unset_ephemeral_fields_when_the_callback_determines_the_recipient(): void
    {
        $params = EphemeralMessageParameters::make()
            ->withReceiverUserId(null)
            ->withCallbackQueryId('callback-id')
            ->withReplaceCallbackQueryMessage(false);

        $params->validate();

        $this->assertNull($params->getReceiverUserId());
        $this->assertSame(['callback_query_id' => 'callback-id', 'replace_callback_query_message' => false], $params->toArray());
    }

    public function test_it_serializes_widget_options_for_the_api_and_webhook(): void
    {
        $request = (new SendWidgetRequest(123, '<p>Hello</p>'))
            ->messageThreadId(8)
            ->width(180)
            ->height(200)
            ->chatData('')
            ->isShared(true)
            ->allowQueries(true)
            ->caption('Hello')
            ->captionEntities([new MessageEntity(['type' => 'bold', 'offset' => 0, 'length' => 5])])
            ->replyParameters(ReplyParameters::make(22))
            ->replyMarkup(['inline_keyboard' => [[['text' => 'Continue', 'callback_data' => 'continue']]]]);

        $request->validate();
        $params = $request->toArray();
        $webhook = $request->toWebhookPayload();

        $this->assertSame(180, $params['width']);
        $this->assertSame('', $params['chat_data']);
        $this->assertTrue($params['allow_queries']);
        $this->assertSame('sendWidget', $webhook['method']);
        $this->assertSame([['type' => 'bold', 'offset' => 0, 'length' => 5]], $webhook['caption_entities']);
        $this->assertSame('{"message_id":22}', $params['reply_parameters']);
        $this->assertSame('continue', $webhook['reply_markup']['inline_keyboard'][0][0]['callback_data']);
    }

    public function test_it_keeps_empty_widget_data_when_an_edit_clears_it(): void
    {
        $message = (new EditMessageWidgetDataRequest)->inlineMessageId('inline-id')->chatData('');
        $shared = (new EditSharedWidgetDataRequest('widget-id', ''))->cacheTime(5);

        $this->assertSame('', $message->toWebhookPayload()['chat_data']);
        $this->assertSame('', $shared->toWebhookPayload()['public_data']);
        $this->assertSame(5, $shared->toWebhookPayload()['cache_time']);
    }

    /**
     * @dataProvider invalidWidgetRequests
     */
    public function test_it_rejects_invalid_widget_requests(TelegramApiRequest $request, string $error): void
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage($error);

        $request->validate();
    }

    /**
     * @return array<string, array{TelegramApiRequest, string}>
     */
    public static function invalidWidgetRequests(): array
    {
        return [
            'missing HTML' => [new SendWidgetRequest(123, ''), 'html must contain'],
            'HTML byte limit' => [new SendWidgetRequest(123, str_repeat('a', 32769)), 'html must contain'],
            'widget data byte limit' => [(new SendWidgetRequest(123, 'hello'))->publicData(str_repeat('é', 513)), 'public_data'],
            'shared widget id' => [new SendSharedWidgetRequest(123, ''), 'widget_id'],
            'query answer byte limit' => [(new AnswerWidgetQueryRequest('query-id'))->data(str_repeat('a', 1025)), 'data'],
            'ambiguous edit target' => [(new EditMessageWidgetDataRequest)->chatId(123)->messageId(9)->inlineMessageId('inline-id'), 'inline_message_id'],
            'incomplete edit target' => [(new EditMessageWidgetDataRequest)->chatId(123), 'chat_id and message_id'],
            'shared widget cache lifetime' => [(new EditSharedWidgetDataRequest('widget-id', ''))->cacheTime(3601), 'cache_time'],
        ];
    }

    public function test_it_serializes_both_verification_description_formats(): void
    {
        $chat = (new VerifyChatRequest('@channel'))->customDescription('<a href="https://example.com">Link</a>')
            ->customDescriptionParseMode(ParseMode::HTML);
        $entity = ['type' => 'text_link', 'offset' => 0, 'length' => 4, 'url' => 'https://example.com'];
        $user = (new VerifyUserRequest(123, 'Link'))->customDescriptionEntities([$entity]);

        $this->assertSame('HTML', $chat->toWebhookPayload()['custom_description_parse_mode']);
        $this->assertSame([$entity], $user->toWebhookPayload()['custom_description_entities']);
        $this->assertSame([$entity], json_decode($user->toArray()['custom_description_entities'], true));
        $this->assertSame(['user_id' => 123], (new VerifyUserRequest(123))->toArray());
    }

    public function test_it_rejects_entities_other_than_links_in_verification_descriptions(): void
    {
        $request = (new VerifyUserRequest(123, 'Link'))->customDescriptionEntities([
            ['type' => 'bold', 'offset' => 0, 'length' => 4],
        ]);

        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('only supports text_link');

        $request->validate();
    }

    public function test_it_serializes_rich_reply_quotes_without_losing_strings_or_nesting(): void
    {
        $texts = ['Hello ', [['type' => 'bold', 'text' => ['a', ['type' => 'italic', 'text' => 'b']]]]];
        $request = (new SendMessageRequest(123, 'Reply'))->setReplyParameters(
            ReplyParameters::make(22)->withQuoteRichTexts($texts)->withQuotePosition(3)
        );

        $this->assertSame([
            'message_id' => 22,
            'quote_rich_texts' => $texts,
            'quote_position' => 3,
        ], $request->toWebhookPayload()['reply_parameters']);
    }
}
