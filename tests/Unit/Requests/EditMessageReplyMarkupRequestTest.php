<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Requests\EditMessageReplyMarkupRequest;

class EditMessageReplyMarkupRequestTest extends TestCase
{
    public function test_it_serializes_to_array_correctly()
    {
        $request = new EditMessageReplyMarkupRequest;
        $request->chatId(123);
        $request->messageId(456);
        $request->replyMarkup(['inline_keyboard' => []]);

        $array = $request->toArray();

        $this->assertEquals(123, $array['chat_id']);
        $this->assertEquals(456, $array['message_id']);
        $this->assertIsString($array['reply_markup']);
        $this->assertSame(json_encode(['inline_keyboard' => []]), $array['reply_markup']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new EditMessageReplyMarkupRequest;
        $this->assertEquals('editMessageReplyMarkup', $request->getMethod());
    }
}
