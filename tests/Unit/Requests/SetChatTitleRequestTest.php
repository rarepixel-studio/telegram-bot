<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SetChatTitleRequest;

class SetChatTitleRequestTest extends TestCase
{
    public function test_it_validates_title_too_short()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('title must be between 1 and 255 characters');

        $request = new SetChatTitleRequest(-100123456789, '');
        $request->validate();
    }

    public function test_it_validates_title_too_long()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('title must be between 1 and 255 characters');

        $request = new SetChatTitleRequest(-100123456789, str_repeat('a', 256));
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new SetChatTitleRequest(-100123456789, 'New Chat Title');

        $array = $request->toArray();

        $this->assertEquals(-100123456789, $array['chat_id']);
        $this->assertEquals('New Chat Title', $array['title']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SetChatTitleRequest(-100123456789, 'Title');
        $this->assertEquals('setChatTitle', $request->getMethod());
    }
}
