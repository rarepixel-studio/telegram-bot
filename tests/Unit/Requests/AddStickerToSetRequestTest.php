<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\InputSticker;
use Telegram\Bot\Requests\AddStickerToSetRequest;

class AddStickerToSetRequestTest extends TestCase
{
    public function test_it_validates_invalid_user_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('user_id must be greater than 0');

        $request = new AddStickerToSetRequest(0, 'name', new InputSticker([]));
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $sticker = new InputSticker([]);
        $request = new AddStickerToSetRequest(123, 'name', $sticker);

        $array = $request->toArray();

        $this->assertEquals(123, $array['user_id']);
        $this->assertEquals('name', $array['name']);
        $this->assertEquals($sticker->toArray(), $array['sticker']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new AddStickerToSetRequest(123, 'name', new InputSticker([]));
        $this->assertEquals('addStickerToSet', $request->getMethod());
    }
}
