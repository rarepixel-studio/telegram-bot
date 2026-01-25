<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Requests\RemoveChatVerificationRequest;

class RemoveChatVerificationRequestTest extends TestCase
{
    public function test_it_serializes_to_array_correctly()
    {
        $request = new RemoveChatVerificationRequest(123);

        $array = $request->toArray();

        $this->assertEquals(123, $array['chat_id']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new RemoveChatVerificationRequest(123);
        $this->assertEquals('removeChatVerification', $request->getMethod());
    }
}
