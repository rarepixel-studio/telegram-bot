<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\DeleteStoryRequest;

class DeleteStoryRequestTest extends TestCase
{
    public function test_it_validates_invalid_story_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('story_id must be greater than 0');

        $request = new DeleteStoryRequest(123, 0);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new DeleteStoryRequest(123, 55);

        $array = $request->toArray();

        $this->assertEquals(123, $array['chat_id']);
        $this->assertEquals(55, $array['story_id']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new DeleteStoryRequest(123, 55);
        $this->assertEquals('deleteStory', $request->getMethod());
    }
}
