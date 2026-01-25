<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\EditChatInviteLinkRequest;

class EditChatInviteLinkRequestTest extends TestCase
{
    public function test_it_validates_empty_invite_link()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('invite_link cannot be empty');

        $request = new EditChatInviteLinkRequest(-100123456789, '');
        $request->validate();
    }

    public function test_it_validates_name_too_long()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('name must not exceed 32 characters');

        $request = new EditChatInviteLinkRequest(-100123456789, 'https://t.me/+abc123');
        $request->name('This is a very long invite link name that exceeds the limit');
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new EditChatInviteLinkRequest(-100123456789, 'https://t.me/+abc123');
        $request->name('Updated Name')->memberLimit(50);

        $array = $request->toArray();

        $this->assertEquals(-100123456789, $array['chat_id']);
        $this->assertEquals('https://t.me/+abc123', $array['invite_link']);
        $this->assertEquals('Updated Name', $array['name']);
        $this->assertEquals(50, $array['member_limit']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new EditChatInviteLinkRequest(-100123456789, 'https://t.me/+abc123');
        $this->assertEquals('editChatInviteLink', $request->getMethod());
    }
}
