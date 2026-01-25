<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\TransferGiftRequest;

class TransferGiftRequestTest extends TestCase
{
    public function test_it_validates_invalid_user_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('user_id must be greater than 0');

        $request = new TransferGiftRequest(0, 'gift_1', 456);
        $request->validate();
    }

    public function test_it_validates_empty_gift_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('gift_id cannot be empty');

        $request = new TransferGiftRequest(123, '', 456);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new TransferGiftRequest(123, 'gift_1', 456);

        $array = $request->toArray();

        $this->assertEquals(123, $array['user_id']);
        $this->assertEquals('gift_1', $array['gift_id']);
        $this->assertEquals(456, $array['recipient_id']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new TransferGiftRequest(123, 'gift_1', 456);
        $this->assertEquals('transferGift', $request->getMethod());
    }
}
