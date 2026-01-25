<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SetStickerSetTitleRequest;

class SetStickerSetTitleRequestTest extends TestCase
{
    public function test_it_validates_empty_name()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('name cannot be empty');

        $request = new SetStickerSetTitleRequest('', 'Title');
        $request->validate();
    }

    public function test_it_validates_empty_title()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('title cannot be empty');

        $request = new SetStickerSetTitleRequest('name', '');
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new SetStickerSetTitleRequest('name', 'Title');

        $array = $request->toArray();

        $this->assertEquals('name', $array['name']);
        $this->assertEquals('Title', $array['title']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SetStickerSetTitleRequest('name', 'Title');
        $this->assertEquals('setStickerSetTitle', $request->getMethod());
    }
}
