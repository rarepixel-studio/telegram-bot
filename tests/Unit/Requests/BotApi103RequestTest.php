<?php

namespace Telegram\Bot\Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\EphemeralMessageParameters;
use Telegram\Bot\Objects\InputRichMessage;
use Telegram\Bot\Requests\DeleteEphemeralMessageRequest;
use Telegram\Bot\Requests\EditEphemeralMessageCaptionRequest;
use Telegram\Bot\Requests\EditEphemeralMessageTextRequest;
use Telegram\Bot\Requests\PromoteChatMemberRequest;
use Telegram\Bot\Requests\SendLivePhotoRequest;
use Telegram\Bot\Requests\SendMessageDraftRequest;
use Telegram\Bot\Requests\SendMessageRequest;
use Telegram\Bot\Requests\SendPhotoRequest;
use Telegram\Bot\Requests\SendRichMessageDraftRequest;
use Telegram\Bot\Requests\SendRichMessageRequest;

class BotApi103RequestTest extends TestCase
{
    public function test_send_message_serializes_ephemeral_message_parameters(): void
    {
        $request = (new SendMessageRequest(123, 'Hello'))
            ->setEphemeralMessageParameters(
                EphemeralMessageParameters::make(456)
                    ->withCallbackQueryId('query-id')
                    ->withReplaceCallbackQueryMessage(true)
            );

        $params = $request->toArray();

        $this->assertSame(json_encode([
            'receiver_user_id' => 456,
            'callback_query_id' => 'query-id',
            'replace_callback_query_message' => true,
        ]), $params['ephemeral_message_parameters']);
        $this->assertArrayNotHasKey('receiver_user_id', $params);
        $this->assertArrayNotHasKey('callback_query_id', $params);
    }

    public function test_send_message_maps_legacy_ephemeral_helpers(): void
    {
        $request = (new SendMessageRequest(123, 'Hello'))
            ->receiverUserId(456)
            ->callbackQueryId('query-id');

        $params = $request->toArray();

        $this->assertSame(json_encode([
            'receiver_user_id' => 456,
            'callback_query_id' => 'query-id',
        ]), $params['ephemeral_message_parameters']);
    }

    public function test_ephemeral_message_parameters_require_receiver_user_id(): void
    {
        $request = (new SendMessageRequest(123, 'Hello'))
            ->setEphemeralMessageParameters([]);

        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('receiver_user_id is required');

        $request->validate();
    }

    public function test_send_photo_and_rich_message_accept_ephemeral_parameters(): void
    {
        $photo = (new SendPhotoRequest(123, 'file-id'))
            ->ephemeralMessageParameters(['receiver_user_id' => 456]);
        $rich = (new SendRichMessageRequest(123, ['html' => '<b>Hi</b>']))
            ->receiverUserId(789);

        $this->assertSame(json_encode(['receiver_user_id' => 456]), $photo->toArray()['ephemeral_message_parameters']);
        $this->assertSame(json_encode(['receiver_user_id' => 789]), $rich->toArray()['ephemeral_message_parameters']);
    }

    public function test_send_live_photo_accepts_ephemeral_parameters(): void
    {
        $request = (new SendLivePhotoRequest(123, 'live-file', 'photo-file'))
            ->ephemeralMessageParameters(EphemeralMessageParameters::make(10));

        $this->assertSame(json_encode(['receiver_user_id' => 10]), $request->toArray()['ephemeral_message_parameters']);
    }

    public function test_message_drafts_accept_stop_parameters(): void
    {
        $textDraft = (new SendMessageDraftRequest(123, 1, 'Thinking'))
            ->setCanStop(true)
            ->setKeepOnStop(true);
        $richDraft = (new SendRichMessageDraftRequest(123, 2, new InputRichMessage(['markdown' => '**Hi**'])))
            ->canStop(true)
            ->keepOnStop(false);

        $this->assertTrue($textDraft->toArray()['can_stop']);
        $this->assertTrue($textDraft->toArray()['keep_on_stop']);
        $this->assertTrue($richDraft->toArray()['can_stop']);
        $this->assertFalse($richDraft->toArray()['keep_on_stop']);
    }

    public function test_promote_chat_member_serializes_welcome_message_right(): void
    {
        $request = (new PromoteChatMemberRequest(-100, 12345))
            ->canSendWelcomeMessages(true)
            ->canManageDirectMessages(true);

        $params = $request->toArray();

        $this->assertTrue($params['can_send_welcome_messages']);
        $this->assertTrue($params['can_manage_direct_messages']);
    }

    public function test_edit_ephemeral_message_text_accepts_rich_message_and_receiver(): void
    {
        $request = (new EditEphemeralMessageTextRequest(new InputRichMessage(['html' => '<i>Hi</i>'])))
            ->chatId(-100)
            ->receiverUserId(456)
            ->ephemeralMessageId('12');

        $params = $request->toArray();

        $this->assertSame(-100, $params['chat_id']);
        $this->assertSame(456, $params['receiver_user_id']);
        $this->assertSame('12', $params['ephemeral_message_id']);
        $this->assertSame(json_encode(['html' => '<i>Hi</i>']), $params['rich_message']);
        $this->assertArrayNotHasKey('text', $params);
    }

    public function test_edit_ephemeral_message_caption_accepts_show_caption_above_media(): void
    {
        $request = (new EditEphemeralMessageCaptionRequest)
            ->chatId(-100)
            ->receiverUserId(456)
            ->ephemeralMessageId('12')
            ->caption('Caption')
            ->showCaptionAboveMedia(true);

        $params = $request->toArray();

        $this->assertTrue($params['show_caption_above_media']);
        $this->assertSame(456, $params['receiver_user_id']);
    }

    public function test_delete_ephemeral_message_includes_receiver_user_id(): void
    {
        $request = new DeleteEphemeralMessageRequest(-100, 456, 12);

        $this->assertSame([
            'chat_id' => -100,
            'receiver_user_id' => 456,
            'ephemeral_message_id' => 12,
        ], $request->toArray());
    }
}
