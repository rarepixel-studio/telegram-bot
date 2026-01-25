<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Requests\SetChatMenuButtonRequest;

class SetChatMenuButtonRequestTest extends TestCase
{
    public function test_it_serializes_to_array_correctly()
    {
        $request = new SetChatMenuButtonRequest;
        $request->chatId(12345);
        $request->menuButton(['type' => 'default']);

        $array = $request->toArray();

        $this->assertEquals(12345, $array['chat_id']);
        $this->assertSame(json_encode(['type' => 'default']), $array['menu_button']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SetChatMenuButtonRequest;
        $this->assertEquals('setChatMenuButton', $request->getMethod());
    }
}
