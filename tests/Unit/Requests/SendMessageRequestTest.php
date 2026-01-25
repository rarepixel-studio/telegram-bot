<?php

namespace Telegram\Bot\Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Enums\ParseMode;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\InlineKeyboardButton;
use Telegram\Bot\Objects\InlineKeyboardMarkup;
use Telegram\Bot\Requests\SendMessageRequest;

class SendMessageRequestTest extends TestCase
{
    public function test_parse_mode_accepts_enum()
    {
        $request = new SendMessageRequest(123, 'hello');
        $request->setParseMode(ParseMode::HTML);

        $params = $request->toArray();

        $this->assertSame('HTML', $params['parse_mode']);
    }

    public function test_parse_mode_accepts_string()
    {
        $request = new SendMessageRequest(123, 'hello');
        $request->setParseMode('MarkdownV2');

        $params = $request->toArray();

        $this->assertSame('MarkdownV2', $params['parse_mode']);
    }

    public function test_parse_mode_rejects_invalid_string()
    {
        $request = new SendMessageRequest(123, 'hello');

        $this->expectException(TelegramValidationException::class);

        $request->setParseMode('InvalidMode');
    }

    public function test_parse_mode_and_entities_are_mutually_exclusive()
    {
        $request = new SendMessageRequest(123, 'hello');
        $request->setParseMode(ParseMode::HTML);
        $request->setEntities([['type' => 'bold', 'offset' => 0, 'length' => 1]]);

        $this->expectException(TelegramValidationException::class);

        $request->validate();
    }

    public function test_it_normalizes_reply_markup_objects(): void
    {
        $request = new SendMessageRequest(123, 'hello');
        $button = InlineKeyboardButton::make('Visit')->withUrl('https://example.com');
        $markup = InlineKeyboardMarkup::make([[$button]]);

        $request->setReplyMarkup($markup);

        $params = $request->toArray();

        $expected = json_encode([
            'inline_keyboard' => [
                [
                    [
                        'text' => 'Visit',
                        'url' => 'https://example.com',
                    ],
                ],
            ],
        ]);

        $this->assertSame($expected, $params['reply_markup']);
    }

    public function test_it_validates_reply_markup_objects(): void
    {
        $request = new SendMessageRequest(123, 'hello');
        $button = InlineKeyboardButton::make('Broken');
        $markup = InlineKeyboardMarkup::make([[$button]]);

        $request->setReplyMarkup($markup);

        $this->expectException(TelegramValidationException::class);

        $request->validate();
    }
}
