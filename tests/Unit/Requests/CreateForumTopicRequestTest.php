<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\CreateForumTopicRequest;

class CreateForumTopicRequestTest extends TestCase
{
    public function test_it_validates_name_too_short()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('name must be between 1 and 128 characters');

        $request = new CreateForumTopicRequest(-100123456789, '');
        $request->validate();
    }

    public function test_it_validates_name_too_long()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('name must be between 1 and 128 characters');

        $request = new CreateForumTopicRequest(-100123456789, str_repeat('a', 129));
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new CreateForumTopicRequest(-100123456789, 'New Topic');
        $request->iconColor(0xFF0000)->iconCustomEmojiId('emoji_123');

        $array = $request->toArray();

        $this->assertEquals(-100123456789, $array['chat_id']);
        $this->assertEquals('New Topic', $array['name']);
        $this->assertEquals(0xFF0000, $array['icon_color']);
        $this->assertEquals('emoji_123', $array['icon_custom_emoji_id']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new CreateForumTopicRequest(-100123456789, 'Topic');
        $this->assertEquals('createForumTopic', $request->getMethod());
    }
}
