<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\ConvertGiftToStarsRequest;

class ConvertGiftToStarsRequestTest extends TestCase
{
    public function test_it_validates_invalid_user_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('user_id must be greater than 0');

        $request = new ConvertGiftToStarsRequest(0, 'gift_1');
        $request->validate();
    }

    public function test_it_validates_empty_gift_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('gift_id cannot be empty');

        $request = new ConvertGiftToStarsRequest(123, '');
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new ConvertGiftToStarsRequest(123, 'gift_1');

        $array = $request->toArray();

        $this->assertEquals(123, $array['user_id']);
        $this->assertEquals('gift_1', $array['gift_id']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new ConvertGiftToStarsRequest(123, 'gift_1');
        $this->assertEquals('convertGiftToStars', $request->getMethod());
    }
}
