<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\PinChatMessageRequest;

class PinChatMessageRequestTest extends TestCase
{
    public function test_it_validates_invalid_message_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('message_id must be greater than 0');

        $request = new PinChatMessageRequest(-100123456789, 0);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new PinChatMessageRequest(-100123456789, 12345);
        $request->disableNotification(true);

        $array = $request->toArray();

        $this->assertEquals(-100123456789, $array['chat_id']);
        $this->assertEquals(12345, $array['message_id']);
        $this->assertTrue($array['disable_notification']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new PinChatMessageRequest(-100123456789, 12345);
        $this->assertEquals('pinChatMessage', $request->getMethod());
    }
}
