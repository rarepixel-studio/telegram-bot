<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SetMyDescriptionRequest;

class SetMyDescriptionRequestTest extends TestCase
{
    public function test_it_validates_description_too_long()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('description must not exceed 512 characters');

        $request = new SetMyDescriptionRequest;
        $request->description(str_repeat('a', 513));
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new SetMyDescriptionRequest;
        $request->description('Bot Description');
        $request->languageCode('en');

        $array = $request->toArray();

        $this->assertEquals('Bot Description', $array['description']);
        $this->assertEquals('en', $array['language_code']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SetMyDescriptionRequest;
        $this->assertEquals('setMyDescription', $request->getMethod());
    }
}
