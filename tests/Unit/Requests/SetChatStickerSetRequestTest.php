<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SetChatStickerSetRequest;

class SetChatStickerSetRequestTest extends TestCase
{
    public function test_it_validates_empty_sticker_set_name()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('sticker_set_name cannot be empty');

        $request = new SetChatStickerSetRequest(-100123456789, '');
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new SetChatStickerSetRequest(-100123456789, 'my_sticker_set');

        $array = $request->toArray();

        $this->assertEquals(-100123456789, $array['chat_id']);
        $this->assertEquals('my_sticker_set', $array['sticker_set_name']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SetChatStickerSetRequest(-100123456789, 'my_sticker_set');
        $this->assertEquals('setChatStickerSet', $request->getMethod());
    }
}
