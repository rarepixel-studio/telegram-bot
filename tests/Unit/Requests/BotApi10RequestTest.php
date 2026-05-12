<?php

namespace Telegram\Bot\Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\InputMediaLivePhoto;
use Telegram\Bot\Objects\InputPaidMediaLivePhoto;
use Telegram\Bot\Requests\AnswerGuestQueryRequest;
use Telegram\Bot\Requests\GetManagedBotAccessSettingsRequest;
use Telegram\Bot\Requests\GetUserPersonalChatMessagesRequest;
use Telegram\Bot\Requests\SendLivePhotoRequest;
use Telegram\Bot\Requests\SendMediaGroupRequest;
use Telegram\Bot\Requests\SendPaidMediaRequest;
use Telegram\Bot\Requests\SetManagedBotAccessSettingsRequest;

class BotApi10RequestTest extends TestCase
{
    public function test_managed_bot_access_requests_use_official_parameter_names(): void
    {
        $getRequest = new GetManagedBotAccessSettingsRequest(123);
        $this->assertSame(['user_id' => 123], $getRequest->toArray());

        $setRequest = (new SetManagedBotAccessSettingsRequest(123, true))->addedUserIds([1, 2]);
        $params = $setRequest->toArray();

        $this->assertSame(123, $params['user_id']);
        $this->assertTrue($params['is_access_restricted']);
        $this->assertSame(json_encode([1, 2]), $params['added_user_ids']);
    }

    public function test_managed_bot_access_rejects_too_many_added_users(): void
    {
        $request = (new SetManagedBotAccessSettingsRequest(123, true))->addedUserIds(range(1, 11));

        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('added_user_ids must not contain more than 10 users');

        $request->validate();
    }

    public function test_get_user_personal_chat_messages_validates_limit(): void
    {
        $request = new GetUserPersonalChatMessagesRequest(123, 21);

        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('limit must be between 1 and 20');

        $request->validate();
    }

    public function test_answer_guest_query_serializes_result(): void
    {
        $request = new AnswerGuestQueryRequest('guest-query-id', [
            'type' => 'article',
            'id' => 'result-id',
            'title' => 'Title',
            'input_message_content' => ['message_text' => 'Hello'],
        ]);

        $params = $request->toArray();

        $this->assertSame('guest-query-id', $params['guest_query_id']);
        $this->assertSame(json_encode([
            'type' => 'article',
            'id' => 'result-id',
            'title' => 'Title',
            'input_message_content' => ['message_text' => 'Hello'],
        ]), $params['result']);
    }

    public function test_send_live_photo_supports_suggested_post_parameters(): void
    {
        $request = (new SendLivePhotoRequest(123, 'live-photo-file-id', 'photo-file-id'))
            ->suggestedPostParameters(['send_date' => time() + 600]);

        $request->validate();
        $params = $request->toArray();

        $this->assertSame('sendLivePhoto', $request->getMethod());
        $this->assertSame('live-photo-file-id', $params['live_photo']);
        $this->assertSame('photo-file-id', $params['photo']);
        $this->assertArrayHasKey('suggested_post_parameters', $params);
    }

    public function test_send_media_group_accepts_live_photo_media(): void
    {
        $media = [
            new InputMediaLivePhoto(['media' => 'live-photo-file-id', 'photo' => 'photo-file-id']),
            ['type' => 'live_photo', 'media' => 'another-live-photo-file-id', 'photo' => 'another-photo-file-id'],
        ];
        $request = new SendMediaGroupRequest(123, $media);

        $request->validate();
        $params = $request->toArray();

        $this->assertInstanceOf(InputMediaLivePhoto::class, $params['media'][0]);
        $this->assertInstanceOf(InputMediaLivePhoto::class, $params['media'][1]);
    }

    public function test_paid_media_accepts_live_photo_media(): void
    {
        $media = [
            new InputPaidMediaLivePhoto(['media' => 'live-photo-file-id', 'photo' => 'photo-file-id']),
            ['type' => 'live_photo', 'media' => 'another-live-photo-file-id', 'photo' => 'another-photo-file-id'],
        ];
        $request = new SendPaidMediaRequest(123, 10, $media);

        $request->validate();

        $this->assertSame('sendPaidMedia', $request->getMethod());
    }

    public function test_live_photo_input_media_extracts_video_and_photo_attachments(): void
    {
        $video = tmpfile();
        $photo = tmpfile();
        $media = new InputMediaLivePhoto(['media' => $video, 'photo' => $photo]);

        $videoAttachment = $media->extractAttachment('__ATTACHED_FILE__');
        $photoAttachment = $media->extractAttachment('__ATTACHED_PHOTO__', 'photo');

        $this->assertSame('__ATTACHED_FILE__', $videoAttachment['name']);
        $this->assertSame('__ATTACHED_PHOTO__', $photoAttachment['name']);
        $this->assertSame('attach://__ATTACHED_FILE__', $media['media']);
        $this->assertSame('attach://__ATTACHED_PHOTO__', $media['photo']);
    }
}
