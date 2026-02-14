<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Objects\InputMedia;
use Telegram\Bot\Requests\EditMessageMediaRequest;

class EditMessageMediaRequestTest extends TestCase
{
    public function test_it_serializes_to_array_correctly()
    {
        $media = new InputMedia(['type' => 'photo', 'media' => 'file_id']);
        $request = new EditMessageMediaRequest($media);
        $request->chatId(123);
        $request->messageId(456);
        $request->media($media);

        $array = $request->toArray();

        $this->assertEquals(123, $array['chat_id']);
        $this->assertEquals(456, $array['message_id']);
        $this->assertSame(json_encode($media->toArray()), $array['media']);
    }

    public function test_it_returns_correct_method_name()
    {
        $media = new InputMedia(['type' => 'photo', 'media' => 'file_id']);
        $request = new EditMessageMediaRequest($media);
        $this->assertEquals('editMessageMedia', $request->getMethod());
    }
}
