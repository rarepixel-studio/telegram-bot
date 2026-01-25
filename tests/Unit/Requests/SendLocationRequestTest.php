<?php

namespace Telegram\Bot\Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SendLocationRequest;

class SendLocationRequestTest extends TestCase
{
    /** @test */
    public function it_creates_a_valid_request()
    {
        $request = new SendLocationRequest(123456, 40.7128, -74.0060);

        $params = $request->toArray();

        $this->assertEquals(123456, $params['chat_id']);
        $this->assertEquals(40.7128, $params['latitude']);
        $this->assertEquals(-74.0060, $params['longitude']);
    }

    /** @test */
    public function it_validates_latitude_range()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Latitude must be between -90 and 90');

        $request = new SendLocationRequest(123456, 91.0, 0.0);
        $request->validate();
    }

    /** @test */
    public function it_validates_longitude_range()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Longitude must be between -180 and 180');

        $request = new SendLocationRequest(123456, 0.0, 181.0);
        $request->validate();
    }

    /** @test */
    public function it_validates_horizontal_accuracy()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Horizontal accuracy must be between 0 and 1500');

        $request = (new SendLocationRequest(123456, 0.0, 0.0))
            ->horizontalAccuracy(1600.0);

        $request->validate();
    }

    /** @test */
    public function it_validates_live_period()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Live period must be between 60 and 86400');

        $request = (new SendLocationRequest(123456, 0.0, 0.0))
            ->livePeriod(30); // Too small

        $request->validate();
    }

    /** @test */
    public function it_allows_indefinite_live_period()
    {
        $request = (new SendLocationRequest(123456, 0.0, 0.0))
            ->livePeriod(0x7FFFFFFF);

        $this->assertNull($request->validate()); // Should not throw exception
        $this->assertEquals(0x7FFFFFFF, $request->toArray()['live_period']);
    }

    /** @test */
    public function it_sets_optional_parameters()
    {
        $request = (new SendLocationRequest(123456, 40.7128, -74.0060))
            ->horizontalAccuracy(50.0)
            ->livePeriod(300)
            ->heading(180)
            ->proximityAlertRadius(500)
            ->disableNotification(true)
            ->protectContent(true);

        $params = $request->toArray();

        $this->assertEquals(50.0, $params['horizontal_accuracy']);
        $this->assertEquals(300, $params['live_period']);
        $this->assertEquals(180, $params['heading']);
        $this->assertEquals(500, $params['proximity_alert_radius']);
        $this->assertTrue($params['disable_notification']);
        $this->assertTrue($params['protect_content']);
    }
}
