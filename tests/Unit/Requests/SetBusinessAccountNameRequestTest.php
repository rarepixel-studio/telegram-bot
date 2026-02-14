<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SetBusinessAccountNameRequest;

class SetBusinessAccountNameRequestTest extends TestCase
{
    public function test_it_validates_empty_connection_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('business_connection_id cannot be empty');

        $request = new SetBusinessAccountNameRequest('', 'New');
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new SetBusinessAccountNameRequest('conn_123', 'New');
        $request->lastName('Biz Name');

        $array = $request->toArray();

        $this->assertEquals('conn_123', $array['business_connection_id']);
        $this->assertEquals('New', $array['first_name']);
        $this->assertEquals('Biz Name', $array['last_name']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SetBusinessAccountNameRequest('conn_123', 'New');
        $this->assertEquals('setBusinessAccountName', $request->getMethod());
    }
}
