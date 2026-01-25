<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\InputSticker;
use Telegram\Bot\Requests\ReplaceStickerInSetRequest;

class ReplaceStickerInSetRequestTest extends TestCase
{
    public function test_it_validates_invalid_user_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('user_id must be greater than 0');

        $request = new ReplaceStickerInSetRequest(0, 'name', 'old_sticker', new InputSticker([]));
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $sticker = new InputSticker([]);
        $request = new ReplaceStickerInSetRequest(123, 'name', 'old_sticker', $sticker);

        $array = $request->toArray();

        $this->assertEquals(123, $array['user_id']);
        $this->assertEquals('name', $array['name']);
        $this->assertEquals('old_sticker', $array['old_sticker']);
        $this->assertSame(json_encode($sticker->toArray()), $array['sticker']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new ReplaceStickerInSetRequest(123, 'name', 'old_sticker', new InputSticker([]));
        $this->assertEquals('replaceStickerInSet', $request->getMethod());
    }
}
