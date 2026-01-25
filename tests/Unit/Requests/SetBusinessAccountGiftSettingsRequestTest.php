<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\BusinessGiftSettings;
use Telegram\Bot\Requests\SetBusinessAccountGiftSettingsRequest;

class SetBusinessAccountGiftSettingsRequestTest extends TestCase
{
    public function test_it_validates_empty_connection_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('business_connection_id cannot be empty');

        $request = new SetBusinessAccountGiftSettingsRequest('', new BusinessGiftSettings([]));
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $settings = new BusinessGiftSettings([]);
        $request = new SetBusinessAccountGiftSettingsRequest('conn_123', $settings);

        $array = $request->toArray();

        $this->assertEquals('conn_123', $array['business_connection_id']);
        $this->assertEquals($settings->toArray(), $array['gift_settings']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SetBusinessAccountGiftSettingsRequest('conn_123', new BusinessGiftSettings([]));
        $this->assertEquals('setBusinessAccountGiftSettings', $request->getMethod());
    }
}
