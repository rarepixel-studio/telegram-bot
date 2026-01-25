<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Requests\SendStickerRequest;

class SendStickerRequestTest extends TestCase
{
    public function test_it_serializes_to_array_correctly()
    {
        $request = new SendStickerRequest(123, 'file_id');
        $request->emoji('😀');

        $array = $request->toArray();

        $this->assertEquals(123, $array['chat_id']);
        $this->assertEquals('file_id', $array['sticker']);
        $this->assertEquals('😀', $array['emoji']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SendStickerRequest(123, 'file_id');
        $this->assertEquals('sendSticker', $request->getMethod());
    }
}
