<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Objects\InputMedia;
use Telegram\Bot\Requests\PostStoryRequest;

class PostStoryRequestTest extends TestCase
{
    public function test_it_serializes_to_array_correctly()
    {
        $media = new InputMedia(['type' => 'photo', 'media' => 'file_id']);
        $request = new PostStoryRequest(123, $media);
        $request->caption('Cool story');
        $request->parseMode('Markdown');

        $array = $request->toArray();

        $this->assertEquals(123, $array['chat_id']);
        $this->assertSame(json_encode($media->toArray()), $array['content']);
        $this->assertEquals('Cool story', $array['caption']);
        $this->assertEquals('Markdown', $array['parse_mode']);
    }

    public function test_it_returns_correct_method_name()
    {
        $media = new InputMedia(['type' => 'photo', 'media' => 'file_id']);
        $request = new PostStoryRequest(123, $media);
        $this->assertEquals('postStory', $request->getMethod());
    }
}
