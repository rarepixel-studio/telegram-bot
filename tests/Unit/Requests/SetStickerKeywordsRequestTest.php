<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SetStickerKeywordsRequest;

class SetStickerKeywordsRequestTest extends TestCase
{
    public function test_it_validates_empty_sticker()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('sticker cannot be empty');

        $request = new SetStickerKeywordsRequest('');
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new SetStickerKeywordsRequest('sticker');
        $request->keywords(['funny', 'cat']);

        $array = $request->toArray();

        $this->assertEquals('sticker', $array['sticker']);
        $this->assertEquals(['funny', 'cat'], $array['keywords']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SetStickerKeywordsRequest('sticker');
        $this->assertEquals('setStickerKeywords', $request->getMethod());
    }
}
