<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SetMyNameRequest;

class SetMyNameRequestTest extends TestCase
{
    public function test_it_validates_name_too_long()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('name must not exceed 64 characters');

        $request = new SetMyNameRequest;
        $request->name(str_repeat('a', 65));
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new SetMyNameRequest;
        $request->name('Bot Name');
        $request->languageCode('en');

        $array = $request->toArray();

        $this->assertEquals('Bot Name', $array['name']);
        $this->assertEquals('en', $array['language_code']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SetMyNameRequest;
        $this->assertEquals('setMyName', $request->getMethod());
    }
}
