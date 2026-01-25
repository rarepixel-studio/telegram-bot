<?php

namespace Telegram\Bot\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\ForceReply;
use Telegram\Bot\Objects\InlineKeyboardButton;
use Telegram\Bot\Objects\KeyboardButton;
use Telegram\Bot\Objects\KeyboardButtonRequestUsers;
use Telegram\Bot\Objects\ReplyKeyboardRemove;

class ReplyMarkupTest extends TestCase
{
    public function test_it_throws_exception_when_inline_keyboard_button_has_no_action(): void
    {
        $button = InlineKeyboardButton::make('Click');

        $this->expectException(TelegramValidationException::class);

        $button->validate();
    }

    public function test_it_throws_exception_when_inline_keyboard_button_has_multiple_actions(): void
    {
        $button = InlineKeyboardButton::make('Click')
            ->withUrl('https://example.com')
            ->withCallbackData('data');

        $this->expectException(TelegramValidationException::class);

        $button->validate();
    }

    public function test_it_throws_exception_when_inline_keyboard_button_has_invalid_web_app(): void
    {
        $button = InlineKeyboardButton::make('Open')
            ->withWebApp(['url' => 'http://example.com']);

        $this->expectException(TelegramValidationException::class);

        $button->validate();
    }

    public function test_it_throws_exception_when_keyboard_button_has_multiple_options(): void
    {
        $button = KeyboardButton::make('Share')
            ->withRequestContact(true)
            ->withRequestLocation(true);

        $this->expectException(TelegramValidationException::class);

        $button->validate();
    }

    public function test_it_converts_keyboard_button_request_users_array_to_object_on_validate(): void
    {
        $button = KeyboardButton::make('Share')
            ->withRequestUsers(['request_id' => 10]);

        $button->validate();

        $requestUsers = $button->getRequestUsers();

        $this->assertInstanceOf(KeyboardButtonRequestUsers::class, $requestUsers);
        $this->assertSame(10, $requestUsers->getRequestId());
    }

    public function test_it_throws_exception_when_reply_keyboard_remove_is_false(): void
    {
        $remove = ReplyKeyboardRemove::fromArray(['remove_keyboard' => false]);

        $this->expectException(TelegramValidationException::class);

        $remove->validate();
    }

    public function test_it_throws_exception_when_force_reply_is_false(): void
    {
        $forceReply = ForceReply::fromArray(['force_reply' => false]);

        $this->expectException(TelegramValidationException::class);

        $forceReply->validate();
    }
}
