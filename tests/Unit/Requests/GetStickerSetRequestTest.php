<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\GetStickerSetRequest;

class GetStickerSetRequestTest extends TestCase
{
    public function test_it_validates_empty_name()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('name cannot be empty');

        $request = new GetStickerSetRequest('');
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new GetStickerSetRequest('test_set');

        $array = $request->toArray();

        $this->assertEquals('test_set', $array['name']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new GetStickerSetRequest('test_set');
        $this->assertEquals('getStickerSet', $request->getMethod());
    }
}
