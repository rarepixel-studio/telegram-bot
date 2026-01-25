<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\VerifyUserRequest;

class VerifyUserRequestTest extends TestCase
{
    public function test_it_validates_invalid_user_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('user_id must be greater than 0');

        $request = new VerifyUserRequest(0, 'desc');
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new VerifyUserRequest(123, 'Verified user');

        $array = $request->toArray();

        $this->assertEquals(123, $array['user_id']);
        $this->assertEquals('Verified user', $array['custom_description']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new VerifyUserRequest(123, 'desc');
        $this->assertEquals('verifyUser', $request->getMethod());
    }
}
