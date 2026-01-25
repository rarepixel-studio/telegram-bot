<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\EditChatSubscriptionInviteLinkRequest;

class EditChatSubscriptionInviteLinkRequestTest extends TestCase
{
    public function test_it_validates_empty_invite_link()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('invite_link cannot be empty');

        $request = new EditChatSubscriptionInviteLinkRequest(-100123456789, '');
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new EditChatSubscriptionInviteLinkRequest(-100123456789, 'https://t.me/+sub123');
        $request->name('Premium Monthly');

        $array = $request->toArray();

        $this->assertEquals(-100123456789, $array['chat_id']);
        $this->assertEquals('https://t.me/+sub123', $array['invite_link']);
        $this->assertEquals('Premium Monthly', $array['name']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new EditChatSubscriptionInviteLinkRequest(-100123456789, 'https://t.me/+sub123');
        $this->assertEquals('editChatSubscriptionInviteLink', $request->getMethod());
    }
}
