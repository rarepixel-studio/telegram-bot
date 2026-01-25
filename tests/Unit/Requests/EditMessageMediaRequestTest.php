<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Objects\InputMedia;
use Telegram\Bot\Requests\EditMessageMediaRequest;

class EditMessageMediaRequestTest extends TestCase
{
    public function test_it_serializes_to_array_correctly()
    {
        $request = new EditMessageMediaRequest();
        $request->chatId(123);
        $request->messageId(456);
        $media = new InputMedia(['type' => 'photo', 'media' => 'file_id']);
        $request->media($media);

        $array = $request->toArray();

        $this->assertEquals(123, $array['chat_id']);
        $this->assertEquals(456, $array['message_id']);
        $this->assertEquals($media->toArray(), $array['media']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new EditMessageMediaRequest();
        $this->assertEquals('editMessageMedia', $request->getMethod());
    }
}
