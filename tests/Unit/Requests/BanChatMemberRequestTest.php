<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\BanChatMemberRequest;

class BanChatMemberRequestTest extends TestCase
{
    public function test_it_validates_invalid_user_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('user_id must be greater than 0');

        $request = new BanChatMemberRequest(-100123456789, 0);
        $request->validate();
    }

    public function test_it_validates_until_date_in_past()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('until_date must be at least 30 seconds in the future');

        $request = new BanChatMemberRequest(-100123456789, 12345);
        $request->untilDate(time() - 100); // Past time
        $request->validate();
    }

    public function test_it_validates_until_date_too_soon()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('until_date must be at least 30 seconds in the future');

        $request = new BanChatMemberRequest(-100123456789, 12345);
        $request->untilDate(time() + 10); // Less than 30 seconds
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $futureTime = time() + 3600;
        $request = new BanChatMemberRequest(-100123456789, 12345);
        $request->untilDate($futureTime)->revokeMessages(true);

        $array = $request->toArray();

        $this->assertEquals(-100123456789, $array['chat_id']);
        $this->assertEquals(12345, $array['user_id']);
        $this->assertEquals($futureTime, $array['until_date']);
        $this->assertTrue($array['revoke_messages']);
    }

    public function test_it_sets_optional_parameters()
    {
        $request = new BanChatMemberRequest(-100123456789, 12345);
        $request->revokeMessages(false);

        $array = $request->toArray();

        $this->assertFalse($array['revoke_messages']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new BanChatMemberRequest(-100123456789, 12345);
        $this->assertEquals('banChatMember', $request->getMethod());
    }
}
