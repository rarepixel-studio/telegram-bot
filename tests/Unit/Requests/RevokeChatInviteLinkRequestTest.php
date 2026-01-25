<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\RevokeChatInviteLinkRequest;

class RevokeChatInviteLinkRequestTest extends TestCase
{
    public function test_it_validates_empty_invite_link()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('invite_link cannot be empty');

        $request = new RevokeChatInviteLinkRequest(-100123456789, '');
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new RevokeChatInviteLinkRequest(-100123456789, 'https://t.me/+abc123');

        $array = $request->toArray();

        $this->assertEquals(-100123456789, $array['chat_id']);
        $this->assertEquals('https://t.me/+abc123', $array['invite_link']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new RevokeChatInviteLinkRequest(-100123456789, 'https://t.me/+abc123');
        $this->assertEquals('revokeChatInviteLink', $request->getMethod());
    }
}
