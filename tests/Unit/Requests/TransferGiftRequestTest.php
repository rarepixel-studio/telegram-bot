<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\TransferGiftRequest;

class TransferGiftRequestTest extends TestCase
{
    public function test_it_validates_empty_connection_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('business_connection_id cannot be empty');

        $request = new TransferGiftRequest('', 'gift_1', 456);
        $request->validate();
    }

    public function test_it_validates_empty_gift_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('owned_gift_id cannot be empty');

        $request = new TransferGiftRequest('conn_123', '', 456);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new TransferGiftRequest('conn_123', 'gift_1', 456);

        $array = $request->toArray();

        $this->assertEquals('conn_123', $array['business_connection_id']);
        $this->assertEquals('gift_1', $array['owned_gift_id']);
        $this->assertEquals(456, $array['new_owner_chat_id']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new TransferGiftRequest('conn_123', 'gift_1', 456);
        $this->assertEquals('transferGift', $request->getMethod());
    }
}
