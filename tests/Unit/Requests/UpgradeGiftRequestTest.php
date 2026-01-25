<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\UpgradeGiftRequest;

class UpgradeGiftRequestTest extends TestCase
{
    public function test_it_validates_invalid_user_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('user_id must be greater than 0');

        $request = new UpgradeGiftRequest(0, 'gift_1');
        $request->validate();
    }

    public function test_it_validates_empty_gift_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('gift_id cannot be empty');

        $request = new UpgradeGiftRequest(123, '');
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new UpgradeGiftRequest(123, 'gift_1');

        $array = $request->toArray();

        $this->assertEquals(123, $array['user_id']);
        $this->assertEquals('gift_1', $array['gift_id']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new UpgradeGiftRequest(123, 'gift_1');
        $this->assertEquals('upgradeGift', $request->getMethod());
    }
}
