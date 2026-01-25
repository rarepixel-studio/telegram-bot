<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\GetCustomEmojiStickersRequest;

class GetCustomEmojiStickersRequestTest extends TestCase
{
    public function test_it_validates_empty_emoji_ids()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('custom_emoji_ids cannot be empty');

        $request = new GetCustomEmojiStickersRequest([]);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new GetCustomEmojiStickersRequest(['id1', 'id2']);

        $array = $request->toArray();

        $this->assertEquals(['id1', 'id2'], $array['custom_emoji_ids']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new GetCustomEmojiStickersRequest(['id1']);
        $this->assertEquals('getCustomEmojiStickers', $request->getMethod());
    }
}
