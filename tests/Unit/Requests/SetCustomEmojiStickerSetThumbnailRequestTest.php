<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SetCustomEmojiStickerSetThumbnailRequest;

class SetCustomEmojiStickerSetThumbnailRequestTest extends TestCase
{
    public function test_it_validates_empty_name()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('name cannot be empty');

        $request = new SetCustomEmojiStickerSetThumbnailRequest('');
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new SetCustomEmojiStickerSetThumbnailRequest('name');
        $request->customEmojiId('id123');

        $array = $request->toArray();

        $this->assertEquals('name', $array['name']);
        $this->assertEquals('id123', $array['custom_emoji_id']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SetCustomEmojiStickerSetThumbnailRequest('name');
        $this->assertEquals('setCustomEmojiStickerSetThumbnail', $request->getMethod());
    }
}
