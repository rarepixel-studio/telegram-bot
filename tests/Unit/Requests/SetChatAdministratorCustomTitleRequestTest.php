<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SetChatAdministratorCustomTitleRequest;

class SetChatAdministratorCustomTitleRequestTest extends TestCase
{
    public function test_it_validates_invalid_user_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('user_id must be greater than 0');

        $request = new SetChatAdministratorCustomTitleRequest(-100123456789, 0, 'Admin');
        $request->validate();
    }

    public function test_it_validates_title_too_long()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('custom_title must not exceed 16 characters');

        $request = new SetChatAdministratorCustomTitleRequest(-100123456789, 12345, 'This is a very long title');
        $request->validate();
    }

    public function test_it_allows_empty_title()
    {
        $request = new SetChatAdministratorCustomTitleRequest(-100123456789, 12345, '');
        $request->validate();

        $this->assertTrue(true); // No exception thrown
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new SetChatAdministratorCustomTitleRequest(-100123456789, 12345, 'Super Admin');

        $array = $request->toArray();

        $this->assertEquals(-100123456789, $array['chat_id']);
        $this->assertEquals(12345, $array['user_id']);
        $this->assertEquals('Super Admin', $array['custom_title']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SetChatAdministratorCustomTitleRequest(-100123456789, 12345, 'Admin');
        $this->assertEquals('setChatAdministratorCustomTitle', $request->getMethod());
    }
}
