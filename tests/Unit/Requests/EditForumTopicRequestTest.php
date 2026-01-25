<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\EditForumTopicRequest;

class EditForumTopicRequestTest extends TestCase
{
    public function test_it_validates_invalid_message_thread_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('message_thread_id must be greater than 0');

        $request = new EditForumTopicRequest(-100123456789, 0);
        $request->validate();
    }

    public function test_it_validates_name_too_long()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('name must be between 1 and 128 characters');

        $request = new EditForumTopicRequest(-100123456789, 123);
        $request->name(str_repeat('a', 129));
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new EditForumTopicRequest(-100123456789, 123);
        $request->name('Updated Topic');

        $array = $request->toArray();

        $this->assertEquals(-100123456789, $array['chat_id']);
        $this->assertEquals(123, $array['message_thread_id']);
        $this->assertEquals('Updated Topic', $array['name']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new EditForumTopicRequest(-100123456789, 123);
        $this->assertEquals('editForumTopic', $request->getMethod());
    }
}
