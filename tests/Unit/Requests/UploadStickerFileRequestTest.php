<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Requests\UploadStickerFileRequest;
use Telegram\Bot\Traits\Http;

class UploadStickerFileRequestTest extends TestCase
{
    public function test_it_validates_invalid_user_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('user_id must be greater than 0');

        $request = new UploadStickerFileRequest(0, new InputFile('file'), 'static');
        $request->validate();
    }

    public function test_it_validates_invalid_format()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Invalid sticker format');

        $request = new UploadStickerFileRequest(123, new InputFile('file'), 'invalid');
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $file = new InputFile('file');
        $request = new UploadStickerFileRequest(123, $file, 'static');

        $array = $request->toArray();

        $this->assertEquals(123, $array['user_id']);
        $this->assertSame($file, $array['sticker']);
        $this->assertEquals('static', $array['sticker_format']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new UploadStickerFileRequest(123, new InputFile('file'), 'static');
        $this->assertEquals('uploadStickerFile', $request->getMethod());
    }
}
