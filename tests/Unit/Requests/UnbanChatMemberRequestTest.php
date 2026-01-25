<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\UnbanChatMemberRequest;

class UnbanChatMemberRequestTest extends TestCase
{
    public function test_it_validates_invalid_user_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('user_id must be greater than 0');

        $request = new UnbanChatMemberRequest(-100123456789, 0);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new UnbanChatMemberRequest(-100123456789, 12345);
        $request->onlyIfBanned(true);

        $array = $request->toArray();

        $this->assertEquals(-100123456789, $array['chat_id']);
        $this->assertEquals(12345, $array['user_id']);
        $this->assertTrue($array['only_if_banned']);
    }

    public function test_it_sets_optional_parameters()
    {
        $request = new UnbanChatMemberRequest(-100123456789, 12345);
        $request->onlyIfBanned(false);

        $array = $request->toArray();

        $this->assertFalse($array['only_if_banned']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new UnbanChatMemberRequest(-100123456789, 12345);
        $this->assertEquals('unbanChatMember', $request->getMethod());
    }
}
