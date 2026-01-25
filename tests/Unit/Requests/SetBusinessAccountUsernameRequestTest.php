<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SetBusinessAccountUsernameRequest;

class SetBusinessAccountUsernameRequestTest extends TestCase
{
    public function test_it_validates_empty_connection_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('business_connection_id cannot be empty');

        $request = new SetBusinessAccountUsernameRequest('');
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new SetBusinessAccountUsernameRequest('conn_123');
        $request->username('new_username');

        $array = $request->toArray();

        $this->assertEquals('conn_123', $array['business_connection_id']);
        $this->assertEquals('new_username', $array['username']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SetBusinessAccountUsernameRequest('conn_123');
        $this->assertEquals('setBusinessAccountUsername', $request->getMethod());
    }
}
