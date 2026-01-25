<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\AcceptedGiftTypes;
use Telegram\Bot\Requests\SetBusinessAccountGiftSettingsRequest;

class SetBusinessAccountGiftSettingsRequestTest extends TestCase
{
    public function test_it_validates_empty_connection_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('business_connection_id cannot be empty');

        $request = new SetBusinessAccountGiftSettingsRequest('', true, new AcceptedGiftTypes([]));
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $acceptedGiftTypes = new AcceptedGiftTypes(['unlimited_gifts' => true]);
        $request = new SetBusinessAccountGiftSettingsRequest('conn_123', true, $acceptedGiftTypes);

        $array = $request->toArray();

        $this->assertEquals('conn_123', $array['business_connection_id']);
        $this->assertTrue($array['show_gift_button']);
        $this->assertSame($acceptedGiftTypes->toArray(), $array['accepted_gift_types']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SetBusinessAccountGiftSettingsRequest('conn_123', true, new AcceptedGiftTypes([]));
        $this->assertEquals('setBusinessAccountGiftSettings', $request->getMethod());
    }
}
