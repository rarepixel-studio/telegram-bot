<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SendGiftRequest;

class SendGiftRequestTest extends TestCase
{
    public function test_it_validates_valid_input()
    {
        $request = new SendGiftRequest(123, 'gift_123');
        $request->validate();

        $this->assertTrue(true);
    }

    public function test_it_validates_invalid_user_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('user_id must be greater than 0');

        $request = new SendGiftRequest(-1, 'gift_123');
        $request->validate();
    }

    public function test_it_validates_missing_gift_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('gift_id cannot be empty');

        $request = new SendGiftRequest(123, '');
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new SendGiftRequest(123, 'gift_123');
        $request->text('Happy Birthday!');
        $request->textParseMode('MarkdownV2');

        $array = $request->toArray();

        $this->assertEquals(123, $array['user_id']);
        $this->assertEquals('gift_123', $array['gift_id']);
        $this->assertEquals('Happy Birthday!', $array['text']);
        $this->assertEquals('MarkdownV2', $array['text_parse_mode']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SendGiftRequest(123, 'gift_123');
        $this->assertEquals('sendGift', $request->getMethod());
    }
}
