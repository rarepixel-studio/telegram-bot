<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\InputMedia;
use Telegram\Bot\Requests\EditStoryRequest;

class EditStoryRequestTest extends TestCase
{
    public function test_it_validates_invalid_story_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('story_id must be greater than 0');

        $request = new EditStoryRequest(123, 0);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new EditStoryRequest(123, 55);
        $media = new InputMedia(['type' => 'photo', 'media' => 'file_id']);
        $request->content($media);
        $request->caption('Edited story');

        $array = $request->toArray();

        $this->assertEquals(123, $array['chat_id']);
        $this->assertEquals(55, $array['story_id']);
        $this->assertSame(json_encode($media->toArray()), $array['content']);
        $this->assertEquals('Edited story', $array['caption']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new EditStoryRequest(123, 55);
        $this->assertEquals('editStory', $request->getMethod());
    }
}
