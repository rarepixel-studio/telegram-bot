<?php

namespace Telegram\Bot\Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Enums\ParseMode;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\InlineKeyboardButton;
use Telegram\Bot\Objects\InlineKeyboardMarkup;
use Telegram\Bot\Requests\CopyMessageRequest;

class CopyMessageRequestTest extends TestCase
{
    public function test_parse_mode_accepts_enum()
    {
        $request = new CopyMessageRequest(123, 456, 789);
        $request->parseMode(ParseMode::Markdown);

        $params = $request->toArray();

        $this->assertSame('Markdown', $params['parse_mode']);
    }

    public function test_parse_mode_accepts_string()
    {
        $request = new CopyMessageRequest(123, 456, 789);
        $request->parseMode('HTML');

        $params = $request->toArray();

        $this->assertSame('HTML', $params['parse_mode']);
    }

    public function test_parse_mode_rejects_invalid_string()
    {
        $request = new CopyMessageRequest(123, 456, 789);

        $this->expectException(TelegramValidationException::class);

        $request->parseMode('InvalidMode');
    }

    public function test_parse_mode_and_caption_entities_are_mutually_exclusive()
    {
        $request = new CopyMessageRequest(123, 456, 789);
        $request->parseMode(ParseMode::HTML);
        $request->captionEntities([['type' => 'bold', 'offset' => 0, 'length' => 1]]);

        $this->expectException(TelegramValidationException::class);

        $request->validate();
    }

    public function test_it_normalizes_reply_markup_objects(): void
    {
        $request = new CopyMessageRequest(123, 456, 789);
        $button = InlineKeyboardButton::make('Visit')->withUrl('https://example.com');
        $markup = InlineKeyboardMarkup::make([[$button]]);

        $request->replyMarkup($markup);

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
}
