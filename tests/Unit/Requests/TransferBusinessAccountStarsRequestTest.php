<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\TransferBusinessAccountStarsRequest;

class TransferBusinessAccountStarsRequestTest extends TestCase
{
    public function test_it_validates_empty_connection_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('business_connection_id cannot be empty');

        $request = new TransferBusinessAccountStarsRequest('', 100, 'trans_1', 123);
        $request->validate();
    }

    public function test_it_validates_invalid_amount()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('star_count must be greater than 0');

        $request = new TransferBusinessAccountStarsRequest('conn_1', 0, 'trans_1', 123);
        $request->validate();
    }

    public function test_it_validates_empty_transfer_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('transfer_id cannot be empty');

        $request = new TransferBusinessAccountStarsRequest('conn_1', 100, '', 123);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new TransferBusinessAccountStarsRequest('conn_123', 100, 'trans_1', 123);
        $request->allowedForPayment(true);

        $array = $request->toArray();

        $this->assertEquals('conn_123', $array['business_connection_id']);
        $this->assertEquals(100, $array['star_count']);
        $this->assertEquals('trans_1', $array['transfer_id']);
        $this->assertEquals(123, $array['recipient']);
        $this->assertTrue($array['allowed_for_payment']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new TransferBusinessAccountStarsRequest('conn_1', 100, 'trans_1', 123);
        $this->assertEquals('transferBusinessAccountStars', $request->getMethod());
    }
}
