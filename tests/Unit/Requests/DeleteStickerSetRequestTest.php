<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\DeleteStickerSetRequest;

class DeleteStickerSetRequestTest extends TestCase
{
    public function test_it_validates_empty_name()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('name cannot be empty');

        $request = new DeleteStickerSetRequest('');
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new DeleteStickerSetRequest('name');

        $array = $request->toArray();

        $this->assertEquals('name', $array['name']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new DeleteStickerSetRequest('name');
        $this->assertEquals('deleteStickerSet', $request->getMethod());
    }
}
