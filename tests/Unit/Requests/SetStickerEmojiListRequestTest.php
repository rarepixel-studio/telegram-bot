<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SetStickerEmojiListRequest;

class SetStickerEmojiListRequestTest extends TestCase
{
    public function test_it_validates_empty_sticker()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('sticker cannot be empty');

        $request = new SetStickerEmojiListRequest('', ['😀']);
        $request->validate();
    }

    public function test_it_validates_empty_emoji_list()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('emoji_list cannot be empty');

        $request = new SetStickerEmojiListRequest('sticker', []);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new SetStickerEmojiListRequest('sticker', ['😀', '😃']);

        $array = $request->toArray();

        $this->assertEquals('sticker', $array['sticker']);
        $this->assertSame(json_encode(['😀', '😃']), $array['emoji_list']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SetStickerEmojiListRequest('sticker', ['😀']);
        $this->assertEquals('setStickerEmojiList', $request->getMethod());
    }
}
