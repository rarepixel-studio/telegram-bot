<?php

namespace Telegram\Bot\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\InputPaidMediaPhoto;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\Objects\MessageId;
use Telegram\Bot\Requests\CopyMessageRequest;
use Telegram\Bot\Requests\CopyMessagesRequest;
use Telegram\Bot\Requests\ForwardMessageRequest;
use Telegram\Bot\Requests\ForwardMessagesRequest;
use Telegram\Bot\Requests\SendAnimationRequest;
use Telegram\Bot\Requests\SendAudioRequest;
use Telegram\Bot\Requests\SendDocumentRequest;
use Telegram\Bot\Requests\SendLivePhotoRequest;
use Telegram\Bot\Requests\SendMessageRequest;
use Telegram\Bot\Requests\SendPaidMediaRequest;
use Telegram\Bot\Requests\SendPhotoRequest;
use Telegram\Bot\Requests\SendVideoNoteRequest;
use Telegram\Bot\Requests\SendVideoRequest;
use Telegram\Bot\Requests\SendVoiceRequest;
use Telegram\Bot\Tests\Mocks\Mocker;

class MessageMethodsTest extends TestCase
{
    /** @test */
    public function it_sends_message_with_request_object()
    {
        $api = Mocker::createApiResponse([
            'message_id' => 123,
            'date' => 1234567890,
            'chat' => ['id' => 456, 'type' => 'private'],
            'text' => 'Hello World',
        ]);

        $request = new SendMessageRequest(456, 'Hello World');
        $response = $api->sendMessage($request);

        $this->assertInstanceOf(Message::class, $response);
        $this->assertEquals(123, $response->getMessageId());
        $this->assertEquals('Hello World', $response->getText());
    }

    /** @test */
    public function it_sends_message_with_optional_parameters()
    {
        $api = Mocker::createApiResponse([
            'message_id' => 124,
            'date' => 1234567890,
            'chat' => ['id' => 789, 'type' => 'private'],
            'text' => 'Test message',
        ]);

        $request = (new SendMessageRequest(789, 'Test message'))
            ->setParseMode('HTML')
            ->setDisableNotification(true)
            ->setProtectContent(true);

        $response = $api->sendMessage($request);

        $this->assertInstanceOf(Message::class, $response);
        $this->assertEquals(124, $response->getMessageId());
    }

    /** @test */
    public function it_throws_validation_exception_when_text_is_empty()
    {
        $request = new SendMessageRequest(123, '');

        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Text cannot be empty');

        $request->validate();
    }

    /** @test */
    public function it_throws_validation_exception_when_text_exceeds_limit()
    {
        $longText = str_repeat('a', 4097);
        $request = new SendMessageRequest(123, $longText);

        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Text must not exceed 4096 characters');

        $request->validate();
    }

    /** @test */
    public function send_message_request_builds_correct_params()
    {
        $request = (new SendMessageRequest(123, 'Hello'))
            ->setParseMode('MarkdownV2')
            ->setDisableNotification(true);

        $params = $request->toArray();

        $this->assertEquals(123, $params['chat_id']);
        $this->assertEquals('Hello', $params['text']);
        $this->assertEquals('MarkdownV2', $params['parse_mode']);
        $this->assertTrue($params['disable_notification']);
        $this->assertArrayNotHasKey('entities', $params);
    }

    /** @test */
    public function it_forwards_message_with_request_object()
    {
        $api = Mocker::createApiResponse([
            'message_id' => 125,
            'date' => 1234567890,
            'chat' => ['id' => 789, 'type' => 'private'],
            'forward_origin' => [
                'type' => 'user',
                'sender_user' => ['id' => 123, 'first_name' => 'Sender', 'is_bot' => false],
                'date' => 1234567880,
            ],
            'text' => 'Forwarded message',
        ]);

        $request = new ForwardMessageRequest(789, 456, 111);
        $response = $api->forwardMessage($request);

        $this->assertInstanceOf(Message::class, $response);
        $this->assertEquals(125, $response->getMessageId());
    }

    /** @test */
    public function forward_message_request_builds_correct_params()
    {
        $request = (new ForwardMessageRequest(789, 456, 111))
            ->disableNotification(true)
            ->protectContent(true)
            ->messageThreadId(999);

        $params = $request->toArray();

        $this->assertEquals(789, $params['chat_id']);
        $this->assertEquals(456, $params['from_chat_id']);
        $this->assertEquals(111, $params['message_id']);
        $this->assertTrue($params['disable_notification']);
        $this->assertTrue($params['protect_content']);
        $this->assertEquals(999, $params['message_thread_id']);
    }

    /** @test */
    public function it_forwards_messages_with_request_object()
    {
        $api = Mocker::createApiResponse([
            ['message_id' => 100],
            ['message_id' => 101],
        ]);

        $request = new ForwardMessagesRequest(789, 456, [1, 2]);
        $response = $api->forwardMessages($request);

        $this->assertInstanceOf('Illuminate\Support\Collection', $response);
        $this->assertCount(2, $response);
        $this->assertInstanceOf(MessageId::class, $response->first());
        $this->assertEquals(100, $response->first()->getMessageId());
    }

    /** @test */
    public function forward_messages_request_builds_correct_params()
    {
        $request = (new ForwardMessagesRequest(789, 456, [1, 2, 3]))
            ->disableNotification(true)
            ->protectContent(true)
            ->messageThreadId(999);

        $params = $request->buildParams();

        $this->assertEquals(789, $params['chat_id']);
        $this->assertEquals(456, $params['from_chat_id']);
        $this->assertEquals([1, 2, 3], $params['message_ids']);
        $this->assertTrue($params['disable_notification']);
        $this->assertTrue($params['protect_content']);
        $this->assertEquals(999, $params['message_thread_id']);
    }

    /** @test */
    public function it_copies_message_with_request_object()
    {
        $api = Mocker::createApiResponse([
            'message_id' => 126,
        ]);

        $request = new CopyMessageRequest(789, 456, 111);
        $response = $api->copyMessage($request);

        $this->assertInstanceOf(MessageId::class, $response);
        $this->assertEquals(126, $response->getMessageId());
    }

    /** @test */
    public function copy_message_request_builds_correct_params()
    {
        $request = (new CopyMessageRequest(789, 456, 111))
            ->caption('New Caption')
            ->parseMode('HTML')
            ->disableNotification(true);

        $params = $request->toArray();

        $this->assertEquals(789, $params['chat_id']);
        $this->assertEquals(456, $params['from_chat_id']);
        $this->assertEquals(111, $params['message_id']);
        $this->assertEquals('New Caption', $params['caption']);
        $this->assertEquals('HTML', $params['parse_mode']);
        $this->assertTrue($params['disable_notification']);
    }

    /** @test */
    public function it_copies_messages_with_request_object()
    {
        $api = Mocker::createApiResponse([
            ['message_id' => 100],
            ['message_id' => 101],
        ]);

        $request = new CopyMessagesRequest(789, 456, [1, 2]);
        $response = $api->copyMessages($request);

        $this->assertInstanceOf('Illuminate\Support\Collection', $response);
        $this->assertCount(2, $response);
        $this->assertInstanceOf(MessageId::class, $response->first());
        $this->assertEquals(100, $response->first()->getMessageId());
    }

    /** @test */
    public function copy_messages_request_builds_correct_params()
    {
        $request = (new CopyMessagesRequest(789, 456, [1, 2, 3]))
            ->removeCaption(true)
            ->disableNotification(true)
            ->protectContent(true)
            ->messageThreadId(999);

        $params = $request->toArray();

        $this->assertEquals(789, $params['chat_id']);
        $this->assertEquals(456, $params['from_chat_id']);
        $this->assertEquals([1, 2, 3], $params['message_ids']);
        $this->assertTrue($params['remove_caption']);
        $this->assertTrue($params['disable_notification']);
        $this->assertTrue($params['protect_content']);
        $this->assertEquals(999, $params['message_thread_id']);
    }

    /** @test */
    public function it_sends_photo_with_request_object()
    {
        $api = Mocker::createApiResponse([
            'message_id' => 127,
            'date' => 1234567890,
            'chat' => ['id' => 789, 'type' => 'private'],
            'photo' => [
                ['file_id' => 'photo_file_id_1', 'width' => 100, 'height' => 100],
                ['file_id' => 'photo_file_id_2', 'width' => 200, 'height' => 200],
            ],
        ]);

        $request = new SendPhotoRequest(789, 'photo_file_id');
        $response = $api->sendPhoto($request);

        $this->assertInstanceOf(Message::class, $response);
        $this->assertEquals(127, $response->getMessageId());
        $this->assertTrue($response->has('photo'));
    }

    /** @test */
    public function send_photo_request_builds_correct_params()
    {
        $request = (new SendPhotoRequest(789, 'photo_file_id'))
            ->caption('Photo Caption')
            ->parseMode('HTML')
            ->hasSpoiler(true)
            ->disableNotification(true)
            ->protectContent(true)
            ->messageThreadId(999);

        $params = $request->toArray();

        $this->assertEquals(789, $params['chat_id']);
        $this->assertEquals('photo_file_id', $params['photo']);
        $this->assertEquals('Photo Caption', $params['caption']);
        $this->assertEquals('HTML', $params['parse_mode']);
        $this->assertTrue($params['has_spoiler']);
        $this->assertTrue($params['disable_notification']);
        $this->assertTrue($params['protect_content']);
        $this->assertEquals(999, $params['message_thread_id']);
    }

    /** @test */
    public function it_sends_audio_with_request_object()
    {
        $api = Mocker::createApiResponse([
            'message_id' => 128,
            'date' => 1234567890,
            'chat' => ['id' => 789, 'type' => 'private'],
            'audio' => ['file_id' => 'audio_file_id', 'duration' => 120],
        ]);

        $request = new SendAudioRequest(789, 'audio_file_id');
        $response = $api->sendAudio($request);

        $this->assertInstanceOf(Message::class, $response);
        $this->assertEquals(128, $response->getMessageId());
        $this->assertTrue($response->has('audio'));
    }

    /** @test */
    public function send_audio_request_builds_correct_params()
    {
        $request = (new SendAudioRequest(789, 'audio_file_id'))
            ->caption('Audio Caption')
            ->parseMode('HTML')
            ->duration(120)
            ->performer('Performer Name')
            ->title('Track Title')
            ->thumbnail('thumb_file_id')
            ->disableNotification(true)
            ->protectContent(true)
            ->messageThreadId(999);

        $params = $request->toArray();

        $this->assertEquals(789, $params['chat_id']);
        $this->assertEquals('audio_file_id', $params['audio']);
        $this->assertEquals('Audio Caption', $params['caption']);
        $this->assertEquals('HTML', $params['parse_mode']);
        $this->assertEquals(120, $params['duration']);
        $this->assertEquals('Performer Name', $params['performer']);
        $this->assertEquals('Track Title', $params['title']);
        $this->assertEquals('thumb_file_id', $params['thumbnail']);
        $this->assertTrue($params['disable_notification']);
        $this->assertTrue($params['protect_content']);
        $this->assertEquals(999, $params['message_thread_id']);
    }

    /** @test */
    public function it_sends_document_with_request_object()
    {
        $api = Mocker::createApiResponse([
            'message_id' => 129,
            'date' => 1234567890,
            'chat' => ['id' => 789, 'type' => 'private'],
            'document' => ['file_id' => 'doc_file_id', 'file_name' => 'test.pdf'],
        ]);

        $request = new SendDocumentRequest(789, 'doc_file_id');
        $response = $api->sendDocument($request);

        $this->assertInstanceOf(Message::class, $response);
        $this->assertEquals(129, $response->getMessageId());
        $this->assertTrue($response->has('document'));
    }

    /** @test */
    public function send_document_request_builds_correct_params()
    {
        $request = (new SendDocumentRequest(789, 'doc_file_id'))
            ->caption('Doc Caption')
            ->parseMode('HTML')
            ->thumbnail('thumb_file_id')
            ->disableContentTypeDetection(true)
            ->disableNotification(true)
            ->protectContent(true)
            ->messageThreadId(999);

        $params = $request->toArray();

        $this->assertEquals(789, $params['chat_id']);
        $this->assertEquals('doc_file_id', $params['document']);
        $this->assertEquals('Doc Caption', $params['caption']);
        $this->assertEquals('HTML', $params['parse_mode']);
        $this->assertEquals('thumb_file_id', $params['thumbnail']);
        $this->assertTrue($params['disable_content_type_detection']);
        $this->assertTrue($params['disable_notification']);
        $this->assertTrue($params['protect_content']);
        $this->assertEquals(999, $params['message_thread_id']);
    }

    /** @test */
    public function it_sends_video_with_request_object()
    {
        $api = Mocker::createApiResponse([
            'message_id' => 130,
            'date' => 1234567890,
            'chat' => ['id' => 789, 'type' => 'private'],
            'video' => ['file_id' => 'video_file_id', 'duration' => 60],
        ]);

        $request = new SendVideoRequest(789, 'video_file_id');
        $response = $api->sendVideo($request);

        $this->assertInstanceOf(Message::class, $response);
        $this->assertEquals(130, $response->getMessageId());
        $this->assertTrue($response->has('video'));
    }

    /** @test */
    public function send_video_request_builds_correct_params()
    {
        $request = (new SendVideoRequest(789, 'video_file_id'))
            ->caption('Video Caption')
            ->parseMode('HTML')
            ->duration(60)
            ->width(1920)
            ->height(1080)
            ->thumbnail('thumb_file_id')
            ->cover('cover_file_id')
            ->startTimestamp(10)
            ->showCaptionAboveMedia(true)
            ->hasSpoiler(true)
            ->supportsStreaming(true)
            ->disableNotification(true)
            ->protectContent(true)
            ->messageThreadId(999);

        $params = $request->toArray();

        $this->assertEquals(789, $params['chat_id']);
        $this->assertEquals('video_file_id', $params['video']);
        $this->assertEquals('Video Caption', $params['caption']);
        $this->assertEquals('HTML', $params['parse_mode']);
        $this->assertEquals(60, $params['duration']);
        $this->assertEquals(1920, $params['width']);
        $this->assertEquals(1080, $params['height']);
        $this->assertEquals('thumb_file_id', $params['thumbnail']);
        $this->assertEquals('cover_file_id', $params['cover']);
        $this->assertEquals(10, $params['start_timestamp']);
        $this->assertTrue($params['show_caption_above_media']);
        $this->assertTrue($params['has_spoiler']);
        $this->assertTrue($params['supports_streaming']);
        $this->assertTrue($params['disable_notification']);
        $this->assertTrue($params['protect_content']);
        $this->assertEquals(999, $params['message_thread_id']);
    }

    /** @test */
    public function it_sends_animation_with_request_object()
    {
        $api = Mocker::createApiResponse([
            'message_id' => 131,
            'date' => 1234567890,
            'chat' => ['id' => 789, 'type' => 'private'],
            'animation' => ['file_id' => 'anim_file_id', 'duration' => 5],
        ]);

        $request = new SendAnimationRequest(789, 'anim_file_id');
        $response = $api->sendAnimation($request);

        $this->assertInstanceOf(Message::class, $response);
        $this->assertEquals(131, $response->getMessageId());
        $this->assertTrue($response->has('animation'));
    }

    /** @test */
    public function send_animation_request_builds_correct_params()
    {
        $request = (new SendAnimationRequest(789, 'anim_file_id'))
            ->caption('Anim Caption')
            ->parseMode('HTML')
            ->duration(5)
            ->width(500)
            ->height(500)
            ->thumbnail('thumb_file_id')
            ->showCaptionAboveMedia(true)
            ->hasSpoiler(true)
            ->disableNotification(true)
            ->protectContent(true)
            ->messageThreadId(999);

        $params = $request->toArray();

        $this->assertEquals(789, $params['chat_id']);
        $this->assertEquals('anim_file_id', $params['animation']);
        $this->assertEquals('Anim Caption', $params['caption']);
        $this->assertEquals('HTML', $params['parse_mode']);
        $this->assertEquals(5, $params['duration']);
        $this->assertEquals(500, $params['width']);
        $this->assertEquals(500, $params['height']);
        $this->assertEquals('thumb_file_id', $params['thumbnail']);
        $this->assertTrue($params['show_caption_above_media']);
        $this->assertTrue($params['has_spoiler']);
        $this->assertTrue($params['disable_notification']);
        $this->assertTrue($params['protect_content']);
        $this->assertEquals(999, $params['message_thread_id']);
    }

    /** @test */
    public function it_sends_voice_message_when_request_object_is_provided(): void
    {
        $api = Mocker::createApiResponse([
            'message_id' => 132,
            'date' => 1234567890,
            'chat' => ['id' => 789, 'type' => 'private'],
            'voice' => ['file_id' => 'voice_file_id', 'duration' => 30],
        ]);

        $request = new SendVoiceRequest(789, 'voice_file_id');
        $response = $api->sendVoice($request);

        $this->assertInstanceOf(Message::class, $response);
        $this->assertEquals(132, $response->getMessageId());
        $this->assertTrue($response->has('voice'));
    }

    /** @test */
    public function it_builds_voice_request_params_when_optional_fields_are_set(): void
    {
        $request = (new SendVoiceRequest(789, 'voice_file_id'))
            ->caption('Voice Caption')
            ->parseMode('HTML')
            ->duration(30)
            ->disableNotification(true)
            ->protectContent(true)
            ->allowPaidBroadcast(true)
            ->messageEffectId('effect-id')
            ->directMessagesTopicId(555)
            ->messageThreadId(999);

        $params = $request->toArray();

        $this->assertEquals(789, $params['chat_id']);
        $this->assertEquals('voice_file_id', $params['voice']);
        $this->assertEquals('Voice Caption', $params['caption']);
        $this->assertEquals('HTML', $params['parse_mode']);
        $this->assertEquals(30, $params['duration']);
        $this->assertTrue($params['disable_notification']);
        $this->assertTrue($params['protect_content']);
        $this->assertTrue($params['allow_paid_broadcast']);
        $this->assertEquals('effect-id', $params['message_effect_id']);
        $this->assertEquals(555, $params['direct_messages_topic_id']);
        $this->assertEquals(999, $params['message_thread_id']);
    }

    /** @test */
    public function it_sends_video_note_when_request_object_is_provided(): void
    {
        $api = Mocker::createApiResponse([
            'message_id' => 133,
            'date' => 1234567890,
            'chat' => ['id' => 789, 'type' => 'private'],
            'video_note' => ['file_id' => 'video_note_file_id', 'length' => 360],
        ]);

        $request = new SendVideoNoteRequest(789, 'video_note_file_id');
        $response = $api->sendVideoNote($request);

        $this->assertInstanceOf(Message::class, $response);
        $this->assertEquals(133, $response->getMessageId());
        $this->assertTrue($response->has('video_note'));
    }

    /** @test */
    public function it_builds_video_note_request_params_when_optional_fields_are_set(): void
    {
        $request = (new SendVideoNoteRequest(789, 'video_note_file_id'))
            ->duration(60)
            ->length(360)
            ->thumbnail('thumb_file_id')
            ->disableNotification(true)
            ->protectContent(true)
            ->allowPaidBroadcast(true)
            ->messageEffectId('effect-id')
            ->directMessagesTopicId(777)
            ->messageThreadId(999);

        $params = $request->toArray();

        $this->assertEquals(789, $params['chat_id']);
        $this->assertEquals('video_note_file_id', $params['video_note']);
        $this->assertEquals(60, $params['duration']);
        $this->assertEquals(360, $params['length']);
        $this->assertEquals('thumb_file_id', $params['thumbnail']);
        $this->assertTrue($params['disable_notification']);
        $this->assertTrue($params['protect_content']);
        $this->assertTrue($params['allow_paid_broadcast']);
        $this->assertEquals('effect-id', $params['message_effect_id']);
        $this->assertEquals(777, $params['direct_messages_topic_id']);
        $this->assertEquals(999, $params['message_thread_id']);
    }

    /** @test */
    public function it_sends_paid_media_when_request_object_is_provided(): void
    {
        $api = Mocker::createApiResponse([
            'message_id' => 134,
            'date' => 1234567890,
            'chat' => ['id' => 789, 'type' => 'private'],
            'text' => 'Paid media',
        ]);

        $media = [new InputPaidMediaPhoto(['media' => 'photo_file_id'])];
        $request = new SendPaidMediaRequest(789, 10, $media);
        $response = $api->sendPaidMedia($request);

        $this->assertInstanceOf(Message::class, $response);
        $this->assertEquals(134, $response->getMessageId());
    }

    /** @test */
    public function it_sends_live_photo_when_request_object_is_provided(): void
    {
        $api = Mocker::createApiResponse([
            'message_id' => 135,
            'date' => 1234567890,
            'chat' => ['id' => 789, 'type' => 'private'],
            'live_photo' => [
                'file_id' => 'live-photo-file-id',
                'file_unique_id' => 'unique-live-photo-file-id',
                'width' => 640,
                'height' => 480,
                'duration' => 4,
            ],
        ]);

        $request = new SendLivePhotoRequest(789, 'live-photo-file-id', 'photo-file-id');
        $response = $api->sendLivePhoto($request);

        $this->assertInstanceOf(Message::class, $response);
        $this->assertEquals(135, $response->getMessageId());
    }

    /** @test */
    public function it_keeps_input_paid_media_objects_when_building_params(): void
    {
        $media = [new InputPaidMediaPhoto(['media' => 'photo_file_id'])];
        $request = (new SendPaidMediaRequest(789, 10, $media))
            ->caption('Paid media caption')
            ->parseMode('HTML')
            ->payload('payload');

        $params = $request->toArray();

        $this->assertEquals(789, $params['chat_id']);
        $this->assertEquals(10, $params['star_count']);
        $this->assertEquals('Paid media caption', $params['caption']);
        $this->assertEquals('HTML', $params['parse_mode']);
        $this->assertEquals('payload', $params['payload']);
        $this->assertInstanceOf(InputPaidMediaPhoto::class, $params['media'][0]);
    }
}
