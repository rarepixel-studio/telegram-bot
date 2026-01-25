<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\RefundStarPaymentRequest;

class RefundStarPaymentRequestTest extends TestCase
{
    public function test_it_validates_invalid_user_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('user_id must be greater than 0');

        $request = new RefundStarPaymentRequest(0, 'id');
        $request->validate();
    }

    public function test_it_validates_empty_charge_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('telegram_payment_charge_id cannot be empty');

        $request = new RefundStarPaymentRequest(123, '');
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new RefundStarPaymentRequest(123, 'charge_id');

        $array = $request->toArray();

        $this->assertEquals(123, $array['user_id']);
        $this->assertEquals('charge_id', $array['telegram_payment_charge_id']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new RefundStarPaymentRequest(123, 'id');
        $this->assertEquals('refundStarPayment', $request->getMethod());
    }
}
