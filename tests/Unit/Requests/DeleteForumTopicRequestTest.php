<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\DeleteForumTopicRequest;

class DeleteForumTopicRequestTest extends TestCase
{
    public function test_it_validates_invalid_message_thread_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('message_thread_id must be greater than 0');

        $request = new DeleteForumTopicRequest(-100123456789, 0);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new DeleteForumTopicRequest(-100123456789, 123);

        $array = $request->toArray();

        $this->assertEquals(-100123456789, $array['chat_id']);
        $this->assertEquals(123, $array['message_thread_id']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new DeleteForumTopicRequest(-100123456789, 123);
        $this->assertEquals('deleteForumTopic', $request->getMethod());
    }
}
