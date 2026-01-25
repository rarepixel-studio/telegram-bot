<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SetMyShortDescriptionRequest;

class SetMyShortDescriptionRequestTest extends TestCase
{
    public function test_it_validates_short_description_too_long()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('short_description must not exceed 120 characters');

        $request = new SetMyShortDescriptionRequest;
        $request->shortDescription(str_repeat('a', 121));
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new SetMyShortDescriptionRequest;
        $request->shortDescription('Short Desc');
        $request->languageCode('en');

        $array = $request->toArray();

        $this->assertEquals('Short Desc', $array['short_description']);
        $this->assertEquals('en', $array['language_code']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SetMyShortDescriptionRequest;
        $this->assertEquals('setMyShortDescription', $request->getMethod());
    }
}
