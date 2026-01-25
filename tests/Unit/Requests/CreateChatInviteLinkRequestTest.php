<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\CreateChatInviteLinkRequest;

class CreateChatInviteLinkRequestTest extends TestCase
{
    public function test_it_validates_name_too_long()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('name must not exceed 32 characters');

        $request = new CreateChatInviteLinkRequest(-100123456789);
        $request->name('This is a very long invite link name that exceeds the limit');
        $request->validate();
    }

    public function test_it_validates_member_limit_too_low()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('member_limit must be between 1 and 99999');

        $request = new CreateChatInviteLinkRequest(-100123456789);
        $request->memberLimit(0);
        $request->validate();
    }

    public function test_it_validates_member_limit_too_high()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('member_limit must be between 1 and 99999');

        $request = new CreateChatInviteLinkRequest(-100123456789);
        $request->memberLimit(100000);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new CreateChatInviteLinkRequest(-100123456789);
        $request->name('VIP Invite')
                ->expireDate(time() + 3600)
                ->memberLimit(100)
                ->createsJoinRequest(true);

        $array = $request->toArray();

        $this->assertEquals(-100123456789, $array['chat_id']);
        $this->assertEquals('VIP Invite', $array['name']);
        $this->assertIsInt($array['expire_date']);
        $this->assertEquals(100, $array['member_limit']);
        $this->assertTrue($array['creates_join_request']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new CreateChatInviteLinkRequest(-100123456789);
        $this->assertEquals('createChatInviteLink', $request->getMethod());
    }
}
