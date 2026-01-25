<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SetStickerPositionInSetRequest;

class SetStickerPositionInSetRequestTest extends TestCase
{
    public function test_it_validates_empty_sticker()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('sticker cannot be empty');

        $request = new SetStickerPositionInSetRequest('', 0);
        $request->validate();
    }

    public function test_it_validates_negative_position()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('position must be non-negative');

        $request = new SetStickerPositionInSetRequest('sticker', -1);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new SetStickerPositionInSetRequest('sticker_file_id', 5);

        $array = $request->toArray();

        $this->assertEquals('sticker_file_id', $array['sticker']);
        $this->assertEquals(5, $array['position']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SetStickerPositionInSetRequest('sticker', 0);
        $this->assertEquals('setStickerPositionInSet', $request->getMethod());
    }
}
