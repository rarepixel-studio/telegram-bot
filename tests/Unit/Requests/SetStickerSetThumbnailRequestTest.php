<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Requests\SetStickerSetThumbnailRequest;

class SetStickerSetThumbnailRequestTest extends TestCase
{
    public function test_it_validates_invalid_user_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('user_id must be greater than 0');

        $request = new SetStickerSetThumbnailRequest('name', 0, 'static');
        $request->validate();
    }

    public function test_it_validates_invalid_format()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Invalid thumbnail format');

        $request = new SetStickerSetThumbnailRequest('name', 123, 'invalid');
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new SetStickerSetThumbnailRequest('name', 123, 'static');
        $request->thumbnail('file_id');

        $array = $request->toArray();

        $this->assertEquals('name', $array['name']);
        $this->assertEquals(123, $array['user_id']);
        $this->assertEquals('static', $array['format']);
        $this->assertEquals('file_id', $array['thumbnail']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SetStickerSetThumbnailRequest('name', 123, 'static');
        $this->assertEquals('setStickerSetThumbnail', $request->getMethod());
    }
}
