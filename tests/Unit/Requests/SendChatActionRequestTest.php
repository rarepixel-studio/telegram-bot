<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SendChatActionRequest;

class SendChatActionRequestTest extends TestCase
{
    public function test_it_validates_invalid_action()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Invalid action');

        $request = new SendChatActionRequest(12345, 'invalid_action');
        $request->validate();
    }

    public function test_it_accepts_valid_actions()
    {
        $validActions = [
            'typing',
            'upload_photo',
            'record_video',
            'upload_video',
            'record_voice',
            'upload_voice',
            'upload_document',
            'choose_sticker',
            'find_location',
            'record_video_note',
            'upload_video_note',
        ];

        foreach ($validActions as $action) {
            $request = new SendChatActionRequest(12345, $action);
            $request->validate(); // Should not throw
            $this->assertTrue(true);
        }
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new SendChatActionRequest(12345, 'typing');
        $request->messageThreadId(10);

        $array = $request->toArray();

        $this->assertEquals(12345, $array['chat_id']);
        $this->assertEquals('typing', $array['action']);
        $this->assertEquals(10, $array['message_thread_id']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SendChatActionRequest(12345, 'typing');
        $this->assertEquals('sendChatAction', $request->getMethod());
    }
}
