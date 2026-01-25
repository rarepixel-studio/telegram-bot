<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Requests\SetChatPermissionsRequest;

class SetChatPermissionsRequestTest extends TestCase
{
    public function test_it_serializes_to_array_correctly()
    {
        $permissions = ['can_send_messages' => false];
        $request = new SetChatPermissionsRequest(-100123456789, $permissions);

        $array = $request->toArray();

        $this->assertEquals(-100123456789, $array['chat_id']);
        $this->assertIsArray($array['permissions']);
    }

    public function test_it_sets_optional_parameters()
    {
        $permissions = ['can_send_messages' => false];
        $request = new SetChatPermissionsRequest(-100123456789, $permissions);
        $request->useIndependentChatPermissions(true);

        $array = $request->toArray();

        $this->assertTrue($array['use_independent_chat_permissions']);
    }

    public function test_it_returns_correct_method_name()
    {
        $permissions = ['can_send_messages' => false];
        $request = new SetChatPermissionsRequest(-100123456789, $permissions);
        $this->assertEquals('setChatPermissions', $request->getMethod());
    }
}
