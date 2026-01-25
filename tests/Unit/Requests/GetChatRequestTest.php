<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Requests\GetChatRequest;

class GetChatRequestTest extends TestCase
{
    public function test_it_serializes_to_array_correctly()
    {
        $request = new GetChatRequest(-100123456789);

        $array = $request->toArray();

        $this->assertEquals(-100123456789, $array['chat_id']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new GetChatRequest(-100123456789);
        $this->assertEquals('getChat', $request->getMethod());
    }
}
