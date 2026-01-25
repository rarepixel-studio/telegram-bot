<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\RestrictChatMemberRequest;

class RestrictChatMemberRequestTest extends TestCase
{
    public function test_it_validates_invalid_user_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('user_id must be greater than 0');

        $permissions = ['can_send_messages' => false];
        $request = new RestrictChatMemberRequest(-100123456789, 0, $permissions);
        $request->validate();
    }

    public function test_it_validates_until_date_too_soon()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('until_date must be at least 30 seconds in the future');

        $permissions = ['can_send_messages' => false];
        $request = new RestrictChatMemberRequest(-100123456789, 12345, $permissions);
        $request->untilDate(time() + 10);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $futureTime = time() + 3600;
        $permissions = ['can_send_messages' => false];
        $request = new RestrictChatMemberRequest(-100123456789, 12345, $permissions);
        $request->untilDate($futureTime);

        $array = $request->toArray();

        $this->assertEquals(-100123456789, $array['chat_id']);
        $this->assertEquals(12345, $array['user_id']);
        $this->assertIsString($array['permissions']);
        $this->assertSame(json_encode($permissions), $array['permissions']);
        $this->assertEquals($futureTime, $array['until_date']);
    }

    public function test_it_accepts_permissions_array()
    {
        $request = new RestrictChatMemberRequest(-100123456789, 12345, ['can_send_messages' => false]);
        $request->validate();

        $array = $request->toArray();
        $this->assertIsString($array['permissions']);
        $this->assertSame(json_encode(['can_send_messages' => false]), $array['permissions']);
    }

    public function test_it_returns_correct_method_name()
    {
        $permissions = ['can_send_messages' => false];
        $request = new RestrictChatMemberRequest(-100123456789, 12345, $permissions);
        $this->assertEquals('restrictChatMember', $request->getMethod());
    }
}
