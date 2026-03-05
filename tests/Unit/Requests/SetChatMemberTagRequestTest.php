<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SetChatMemberTagRequest;

class SetChatMemberTagRequestTest extends TestCase
{
    public function test_it_serializes_to_array_correctly()
    {
        $request = new SetChatMemberTagRequest(-100123456789, 12345);

        $array = $request->toArray();

        $this->assertEquals(-100123456789, $array['chat_id']);
        $this->assertEquals(12345, $array['user_id']);
        $this->assertArrayNotHasKey('tag', $array);
    }

    public function test_it_sets_optional_tag()
    {
        $request = new SetChatMemberTagRequest(-100123456789, 12345);
        $request->tag('VIP');

        $array = $request->toArray();

        $this->assertEquals('VIP', $array['tag']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SetChatMemberTagRequest(-100123456789, 12345);
        $this->assertEquals('setChatMemberTag', $request->getMethod());
    }

    public function test_it_rejects_invalid_user_id()
    {
        $this->expectException(TelegramValidationException::class);

        $request = new SetChatMemberTagRequest(-100123456789, 0);
        $request->validate();
    }

    public function test_it_rejects_tag_exceeding_128_characters()
    {
        $this->expectException(TelegramValidationException::class);

        $request = new SetChatMemberTagRequest(-100123456789, 12345);
        $request->tag(str_repeat('a', 129));
        $request->validate();
    }

    public function test_it_allows_empty_tag_to_remove()
    {
        $request = new SetChatMemberTagRequest(-100123456789, 12345);
        $request->tag('');

        $array = $request->toArray();

        $this->assertSame('', $array['tag']);
    }
}
