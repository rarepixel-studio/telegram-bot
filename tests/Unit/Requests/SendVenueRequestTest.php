<?php

namespace Telegram\Bot\Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SendVenueRequest;

class SendVenueRequestTest extends TestCase
{
    /** @test */
    public function it_creates_a_valid_request()
    {
        $request = new SendVenueRequest(123456, 40.7128, -74.0060, 'Central Park', 'New York, NY');

        $params = $request->toArray();

        $this->assertEquals(123456, $params['chat_id']);
        $this->assertEquals(40.7128, $params['latitude']);
        $this->assertEquals(-74.0060, $params['longitude']);
        $this->assertEquals('Central Park', $params['title']);
        $this->assertEquals('New York, NY', $params['address']);
    }

    /** @test */
    public function it_validates_location_ranges()
    {
        $this->expectException(TelegramValidationException::class);
        $request = new SendVenueRequest(123456, 91.0, 0.0, 'Title', 'Address');
        $request->validate();
    }

    /** @test */
    public function it_validates_empty_title()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Title cannot be empty');

        $request = new SendVenueRequest(123456, 40.7128, -74.0060, '', 'Address');
        $request->validate();
    }

    /** @test */
    public function it_validates_empty_address()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Address cannot be empty');

        $request = new SendVenueRequest(123456, 40.7128, -74.0060, 'Title', '');
        $request->validate();
    }

    /** @test */
    public function it_sets_optional_parameters()
    {
        $request = (new SendVenueRequest(123456, 40.7128, -74.0060, 'Central Park', 'NY'))
            ->foursquareId('4sq123')
            ->foursquareType('park')
            ->googlePlaceId('gp123')
            ->googlePlaceType('park')
            ->disableNotification(true)
            ->protectContent(true);

        $params = $request->toArray();

        $this->assertEquals('4sq123', $params['foursquare_id']);
        $this->assertEquals('park', $params['foursquare_type']);
        $this->assertEquals('gp123', $params['google_place_id']);
        $this->assertEquals('park', $params['google_place_type']);
        $this->assertTrue($params['disable_notification']);
        $this->assertTrue($params['protect_content']);
    }
}
