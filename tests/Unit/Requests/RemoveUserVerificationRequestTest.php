<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\RemoveUserVerificationRequest;

class RemoveUserVerificationRequestTest extends TestCase
{
    public function test_it_validates_invalid_user_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('user_id must be greater than 0');

        $request = new RemoveUserVerificationRequest(0);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new RemoveUserVerificationRequest(123);

        $array = $request->toArray();

        $this->assertEquals(123, $array['user_id']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new RemoveUserVerificationRequest(123);
        $this->assertEquals('removeUserVerification', $request->getMethod());
    }
}
