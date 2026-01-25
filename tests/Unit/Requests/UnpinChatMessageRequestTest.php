<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\UnpinChatMessageRequest;

class UnpinChatMessageRequestTest extends TestCase
{
    public function test_it_validates_invalid_message_id_when_provided()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('message_id must be greater than 0');

        $request = new UnpinChatMessageRequest(-100123456789);
        $request->messageId(0);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly_with_message_id()
    {
        $request = new UnpinChatMessageRequest(-100123456789);
        $request->messageId(12345);

        $array = $request->toArray();

        $this->assertEquals(-100123456789, $array['chat_id']);
        $this->assertEquals(12345, $array['message_id']);
    }

    public function test_it_serializes_to_array_correctly_without_message_id()
    {
        $request = new UnpinChatMessageRequest(-100123456789);

        $array = $request->toArray();

        $this->assertEquals(-100123456789, $array['chat_id']);
        $this->assertArrayNotHasKey('message_id', $array);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new UnpinChatMessageRequest(-100123456789);
        $this->assertEquals('unpinChatMessage', $request->getMethod());
    }
}
