<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SendDiceRequest;

class SendDiceRequestTest extends TestCase
{
    public function test_it_validates_invalid_emoji()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Emoji must be one of');

        $request = new SendDiceRequest(12345);
        $request->emoji('❌'); // Invalid emoji
        $request->validate();
    }

    public function test_it_accepts_valid_emojis()
    {
        $validEmojis = ['🎲', '🎯', '🏀', '⚽', '🎳', '🎰'];

        foreach ($validEmojis as $emoji) {
            $request = new SendDiceRequest(12345);
            $request->emoji($emoji);
            $request->validate(); // Should not throw
            $this->assertTrue(true); // Assertion to mark test as having assertions
        }
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new SendDiceRequest(12345);
        $request->emoji('🎲')->disableNotification(true);

        $array = $request->toArray();

        $this->assertEquals(12345, $array['chat_id']);
        $this->assertEquals('🎲', $array['emoji']);
        $this->assertTrue($array['disable_notification']);
    }

    public function test_it_sets_optional_parameters()
    {
        $request = new SendDiceRequest(12345);
        $request->messageThreadId(10)->protectContent(true);

        $array = $request->toArray();

        $this->assertEquals(10, $array['message_thread_id']);
        $this->assertTrue($array['protect_content']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SendDiceRequest(12345);
        $this->assertEquals('sendDice', $request->getMethod());
    }
}
