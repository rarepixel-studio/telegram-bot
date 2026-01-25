<?php

namespace Telegram\Bot\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Enums\SuggestedPostCurrency;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\SuggestedPostParameters;
use Telegram\Bot\Objects\SuggestedPostPrice;

class SuggestedPostParametersTest extends TestCase
{
    public function test_it_accepts_valid_suggested_post_price_with_enum(): void
    {
        $price = SuggestedPostPrice::make([
            'currency' => SuggestedPostCurrency::TelegramStars,
            'amount' => 5,
        ]);

        $price->validate();

        $this->assertSame('XTR', $price->getCurrency());
    }

    public function test_it_throws_exception_when_suggested_post_price_amount_is_invalid(): void
    {
        $price = SuggestedPostPrice::make([
            'currency' => SuggestedPostCurrency::TelegramStars,
            'amount' => 4,
        ]);

        $this->expectException(TelegramValidationException::class);

        $price->validate();
    }

    public function test_it_throws_exception_when_send_date_is_too_soon(): void
    {
        $params = SuggestedPostParameters::make()
            ->withSendDate(time() + 100);

        $this->expectException(TelegramValidationException::class);

        $params->validate();
    }
}
