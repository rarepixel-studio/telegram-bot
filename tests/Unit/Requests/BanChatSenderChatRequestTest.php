<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Requests\BanChatSenderChatRequest;

class BanChatSenderChatRequestTest extends TestCase
{
    public function test_it_serializes_to_array_correctly()
    {
        $request = new BanChatSenderChatRequest(-100123456789, -100987654321);

        $array = $request->toArray();

        $this->assertEquals(-100123456789, $array['chat_id']);
        $this->assertEquals(-100987654321, $array['sender_chat_id']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new BanChatSenderChatRequest(-100123456789, -100987654321);
        $this->assertEquals('banChatSenderChat', $request->getMethod());
    }
}
