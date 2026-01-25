<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SetChatDescriptionRequest;

class SetChatDescriptionRequestTest extends TestCase
{
    public function test_it_validates_description_too_long()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('description must not exceed 255 characters');

        $request = new SetChatDescriptionRequest(-100123456789);
        $request->description(str_repeat('a', 256));
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new SetChatDescriptionRequest(-100123456789);
        $request->description('New chat description');

        $array = $request->toArray();

        $this->assertEquals(-100123456789, $array['chat_id']);
        $this->assertEquals('New chat description', $array['description']);
    }

    public function test_it_allows_empty_description()
    {
        $request = new SetChatDescriptionRequest(-100123456789);
        $request->description('');

        $array = $request->toArray();

        $this->assertEquals('', $array['description']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SetChatDescriptionRequest(-100123456789);
        $this->assertEquals('setChatDescription', $request->getMethod());
    }
}
