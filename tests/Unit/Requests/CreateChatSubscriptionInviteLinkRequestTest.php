<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\CreateChatSubscriptionInviteLinkRequest;

class CreateChatSubscriptionInviteLinkRequestTest extends TestCase
{
    public function test_it_validates_subscription_period_invalid()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('subscription_period must be greater than 0');

        $request = new CreateChatSubscriptionInviteLinkRequest(-100123456789, 0, 100);
        $request->validate();
    }

    public function test_it_validates_subscription_price_invalid()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('subscription_price must be greater than 0');

        $request = new CreateChatSubscriptionInviteLinkRequest(-100123456789, 2592000, 0);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new CreateChatSubscriptionInviteLinkRequest(-100123456789, 2592000, 100);
        $request->name('Monthly Subscription');

        $array = $request->toArray();

        $this->assertEquals(-100123456789, $array['chat_id']);
        $this->assertEquals(2592000, $array['subscription_period']);
        $this->assertEquals(100, $array['subscription_price']);
        $this->assertEquals('Monthly Subscription', $array['name']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new CreateChatSubscriptionInviteLinkRequest(-100123456789, 2592000, 100);
        $this->assertEquals('createChatSubscriptionInviteLink', $request->getMethod());
    }
}
