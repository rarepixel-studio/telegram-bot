<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Requests\DeclineSuggestedPostRequest;

class DeclineSuggestedPostRequestTest extends TestCase
{
    public function test_it_serializes_to_array_correctly()
    {
        $request = new DeclineSuggestedPostRequest(123, 456);

        $array = $request->toArray();

        $this->assertEquals(123, $array['chat_id']);
        $this->assertEquals(456, $array['message_id']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new DeclineSuggestedPostRequest(123, 456);
        $this->assertEquals('declineSuggestedPost', $request->getMethod());
    }
}
