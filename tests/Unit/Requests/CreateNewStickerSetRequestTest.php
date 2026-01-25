<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\CreateNewStickerSetRequest;

class CreateNewStickerSetRequestTest extends TestCase
{
    public function test_it_validates_invalid_user_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('user_id must be greater than 0');

        $request = new CreateNewStickerSetRequest(0, 'name', 'title', ['stickers']);
        $request->validate();
    }

    public function test_it_validates_empty_stickers()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('stickers cannot be empty');

        $request = new CreateNewStickerSetRequest(123, 'name', 'title', []);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new CreateNewStickerSetRequest(123, 'name', 'title', ['stickers']);
        $request->stickerType('regular');

        $array = $request->toArray();

        $this->assertEquals(123, $array['user_id']);
        $this->assertEquals('name', $array['name']);
        $this->assertEquals('title', $array['title']);
        $this->assertSame(json_encode(['stickers']), $array['stickers']);
        $this->assertEquals('regular', $array['sticker_type']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new CreateNewStickerSetRequest(123, 'name', 'title', ['stickers']);
        $this->assertEquals('createNewStickerSet', $request->getMethod());
    }
}
