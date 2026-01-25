<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\MaskPosition;
use Telegram\Bot\Requests\SetStickerMaskPositionRequest;

class SetStickerMaskPositionRequestTest extends TestCase
{
    public function test_it_validates_empty_sticker()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('sticker cannot be empty');

        $request = new SetStickerMaskPositionRequest('');
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new SetStickerMaskPositionRequest('sticker');
        $mask = new MaskPosition([]);
        $request->maskPosition($mask);

        $array = $request->toArray();

        $this->assertEquals('sticker', $array['sticker']);
        $this->assertEquals($mask->toArray(), $array['mask_position']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SetStickerMaskPositionRequest('sticker');
        $this->assertEquals('setStickerMaskPosition', $request->getMethod());
    }
}
