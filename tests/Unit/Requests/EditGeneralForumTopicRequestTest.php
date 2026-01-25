<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\EditGeneralForumTopicRequest;

class EditGeneralForumTopicRequestTest extends TestCase
{
    public function test_it_validates_name_too_short()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('name must be between 1 and 128 characters');

        $request = new EditGeneralForumTopicRequest(-100123456789, '');
        $request->validate();
    }

    public function test_it_validates_name_too_long()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('name must be between 1 and 128 characters');

        $request = new EditGeneralForumTopicRequest(-100123456789, str_repeat('a', 129));
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new EditGeneralForumTopicRequest(-100123456789, 'General');

        $array = $request->toArray();

        $this->assertEquals(-100123456789, $array['chat_id']);
        $this->assertEquals('General', $array['name']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new EditGeneralForumTopicRequest(-100123456789, 'General');
        $this->assertEquals('editGeneralForumTopic', $request->getMethod());
    }
}
