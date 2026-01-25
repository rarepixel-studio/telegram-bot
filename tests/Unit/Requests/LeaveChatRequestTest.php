<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Requests\LeaveChatRequest;

class LeaveChatRequestTest extends TestCase
{
    public function test_it_serializes_to_array_correctly()
    {
        $request = new LeaveChatRequest(-100123456789);

        $array = $request->toArray();

        $this->assertEquals(-100123456789, $array['chat_id']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new LeaveChatRequest(-100123456789);
        $this->assertEquals('leaveChat', $request->getMethod());
    }
}
