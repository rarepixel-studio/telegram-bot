<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SetBusinessAccountProfilePhotoRequest;

class SetBusinessAccountProfilePhotoRequestTest extends TestCase
{
    public function test_it_validates_empty_connection_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('business_connection_id cannot be empty');

        $request = new SetBusinessAccountProfilePhotoRequest('', 'file_id');
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new SetBusinessAccountProfilePhotoRequest('conn_123', 'file_id');

        $array = $request->toArray();

        $this->assertEquals('conn_123', $array['business_connection_id']);
        $this->assertEquals('file_id', $array['photo']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SetBusinessAccountProfilePhotoRequest('conn_123', 'file_id');
        $this->assertEquals('setBusinessAccountProfilePhoto', $request->getMethod());
    }
}
