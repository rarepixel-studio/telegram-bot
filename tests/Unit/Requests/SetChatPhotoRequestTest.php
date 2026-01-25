<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Requests\SetChatPhotoRequest;

class SetChatPhotoRequestTest extends TestCase
{
    public function test_it_serializes_to_array_correctly()
    {
        $photo = new InputFile('/path/to/photo.jpg');
        $request = new SetChatPhotoRequest(-100123456789, $photo);

        $array = $request->toArray();

        $this->assertEquals(-100123456789, $array['chat_id']);
        $this->assertInstanceOf(InputFile::class, $array['photo']);
    }

    public function test_it_returns_correct_method_name()
    {
        $photo = new InputFile('/path/to/photo.jpg');
        $request = new SetChatPhotoRequest(-100123456789, $photo);
        $this->assertEquals('setChatPhoto', $request->getMethod());
    }
}
