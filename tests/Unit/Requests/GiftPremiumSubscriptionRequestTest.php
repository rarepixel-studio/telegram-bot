<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\GiftPremiumSubscriptionRequest;

class GiftPremiumSubscriptionRequestTest extends TestCase
{
    public function test_it_validates_valid_input()
    {
        $request = new GiftPremiumSubscriptionRequest(123, 6, 1500);
        $request->validate();

        $this->assertTrue(true);
    }

    public function test_it_validates_invalid_month_count()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('month_count must be one of: 3, 6, 12');

        $request = new GiftPremiumSubscriptionRequest(123, 5, 1000);
        $request->validate();
    }

    public function test_it_validates_invalid_star_count_for_month_count()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('star_count must be 1500 when month_count is 6');

        $request = new GiftPremiumSubscriptionRequest(123, 6, 1000);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly(): void
    {
        $request = new GiftPremiumSubscriptionRequest(123, 3, 1000);

        $array = $request->toArray();

        $this->assertEquals(123, $array['user_id']);
        $this->assertEquals(3, $array['month_count']);
        $this->assertEquals(1000, $array['star_count']);
    }

    public function test_it_returns_correct_method_name(): void
    {
        $request = new GiftPremiumSubscriptionRequest(123, 3, 1000);
        $this->assertEquals('giftPremiumSubscription', $request->getMethod());
    }
}
