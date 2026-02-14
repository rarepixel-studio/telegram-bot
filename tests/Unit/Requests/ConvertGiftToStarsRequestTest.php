<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\ConvertGiftToStarsRequest;

class ConvertGiftToStarsRequestTest extends TestCase
{
    public function test_it_validates_empty_connection_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('business_connection_id cannot be empty');

        $request = new ConvertGiftToStarsRequest('', 'gift_1');
        $request->validate();
    }

    public function test_it_validates_empty_gift_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('owned_gift_id cannot be empty');

        $request = new ConvertGiftToStarsRequest('conn_123', '');
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new ConvertGiftToStarsRequest('conn_123', 'gift_1');

        $array = $request->toArray();

        $this->assertEquals('conn_123', $array['business_connection_id']);
        $this->assertEquals('gift_1', $array['owned_gift_id']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new ConvertGiftToStarsRequest('conn_123', 'gift_1');
        $this->assertEquals('convertGiftToStars', $request->getMethod());
    }
}
