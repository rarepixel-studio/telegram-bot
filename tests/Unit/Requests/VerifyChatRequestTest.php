<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Requests\VerifyChatRequest;

class VerifyChatRequestTest extends TestCase
{
    public function test_it_serializes_to_array_correctly()
    {
        $request = new VerifyChatRequest(123, 'Verified chat');

        $array = $request->toArray();

        $this->assertEquals(123, $array['chat_id']);
        $this->assertEquals('Verified chat', $array['custom_description']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new VerifyChatRequest(123, 'desc');
        $this->assertEquals('verifyChat', $request->getMethod());
    }
}
