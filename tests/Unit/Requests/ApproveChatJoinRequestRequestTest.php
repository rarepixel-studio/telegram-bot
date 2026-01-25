<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\ApproveChatJoinRequestRequest;

class ApproveChatJoinRequestRequestTest extends TestCase
{
    public function test_it_validates_invalid_user_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('user_id must be greater than 0');

        $request = new ApproveChatJoinRequestRequest(-100123456789, 0);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new ApproveChatJoinRequestRequest(-100123456789, 12345);

        $array = $request->toArray();

        $this->assertEquals(-100123456789, $array['chat_id']);
        $this->assertEquals(12345, $array['user_id']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new ApproveChatJoinRequestRequest(-100123456789, 12345);
        $this->assertEquals('approveChatJoinRequest', $request->getMethod());
    }
}
