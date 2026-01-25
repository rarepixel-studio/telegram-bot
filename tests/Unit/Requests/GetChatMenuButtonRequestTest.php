<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Requests\GetChatMenuButtonRequest;

class GetChatMenuButtonRequestTest extends TestCase
{
    public function test_it_serializes_to_array_correctly()
    {
        $request = new GetChatMenuButtonRequest;
        $request->chatId(12345);

        $array = $request->toArray();

        $this->assertEquals(12345, $array['chat_id']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new GetChatMenuButtonRequest;
        $this->assertEquals('getChatMenuButton', $request->getMethod());
    }
}
