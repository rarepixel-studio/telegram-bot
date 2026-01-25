<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SetBusinessAccountBioRequest;

class SetBusinessAccountBioRequestTest extends TestCase
{
    public function test_it_validates_empty_connection_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('business_connection_id cannot be empty');

        $request = new SetBusinessAccountBioRequest('');
        $request->validate();
    }

    public function test_it_validates_bio_too_long()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('bio must not exceed 156 characters');

        $request = new SetBusinessAccountBioRequest('conn_123');
        $request->bio(str_repeat('a', 157));
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new SetBusinessAccountBioRequest('conn_123');
        $request->bio('New Bio');

        $array = $request->toArray();

        $this->assertEquals('conn_123', $array['business_connection_id']);
        $this->assertEquals('New Bio', $array['bio']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SetBusinessAccountBioRequest('conn_123');
        $this->assertEquals('setBusinessAccountBio', $request->getMethod());
    }
}
