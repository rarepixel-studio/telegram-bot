<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\EditUserStarSubscriptionRequest;

class EditUserStarSubscriptionRequestTest extends TestCase
{
    public function test_it_validates_invalid_user_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('user_id must be greater than 0');

        $request = new EditUserStarSubscriptionRequest(0, 'charge', true);
        $request->validate();
    }

    public function test_it_validates_empty_charge_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('telegram_payment_charge_id cannot be empty');

        $request = new EditUserStarSubscriptionRequest(123, '', true);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new EditUserStarSubscriptionRequest(123, 'charge', true);

        $array = $request->toArray();

        $this->assertEquals(123, $array['user_id']);
        $this->assertEquals('charge', $array['telegram_payment_charge_id']);
        $this->assertTrue($array['is_canceled']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new EditUserStarSubscriptionRequest(123, 'charge', true);
        $this->assertEquals('editUserStarSubscription', $request->getMethod());
    }
}
