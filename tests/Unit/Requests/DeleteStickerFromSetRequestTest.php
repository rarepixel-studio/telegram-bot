<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\DeleteStickerFromSetRequest;

class DeleteStickerFromSetRequestTest extends TestCase
{
    public function test_it_validates_empty_sticker()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('sticker cannot be empty');

        $request = new DeleteStickerFromSetRequest('');
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new DeleteStickerFromSetRequest('sticker_file_id');

        $array = $request->toArray();

        $this->assertEquals('sticker_file_id', $array['sticker']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new DeleteStickerFromSetRequest('sticker');
        $this->assertEquals('deleteStickerFromSet', $request->getMethod());
    }
}
