<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\RemoveBusinessAccountProfilePhotoRequest;

class RemoveBusinessAccountProfilePhotoRequestTest extends TestCase
{
    public function test_it_validates_empty_connection_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('business_connection_id cannot be empty');

        $request = new RemoveBusinessAccountProfilePhotoRequest('');
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new RemoveBusinessAccountProfilePhotoRequest('conn_123');

        $array = $request->toArray();

        $this->assertEquals('conn_123', $array['business_connection_id']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new RemoveBusinessAccountProfilePhotoRequest('conn_123');
        $this->assertEquals('removeBusinessAccountProfilePhoto', $request->getMethod());
    }
}
