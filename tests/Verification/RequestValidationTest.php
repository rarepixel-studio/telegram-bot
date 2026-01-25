<?php

namespace Telegram\Bot\Tests\Verification;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Requests\EditMessageLiveLocationRequest;
use Telegram\Bot\Requests\EditMessageMediaRequest;
use Telegram\Bot\Requests\EditMessageTextRequest;
use Telegram\Bot\Objects\InputMediaPhoto;

class RequestValidationTest extends TestCase
{
    public function test_edit_message_text_request_requires_text()
    {
        $this->expectException(\TypeError::class);
        // @phpstan-ignore-next-line
        new EditMessageTextRequest();
    }

    public function test_edit_message_text_request_can_be_instantiated_with_text()
    {
        $request = new EditMessageTextRequest('Hello');
        $params = $request->toRequestParams();
        $this->assertEquals('Hello', $params['text']);
    }

    public function test_edit_message_live_location_request_requires_lat_lon()
    {
        $this->expectException(\TypeError::class);
        // @phpstan-ignore-next-line
        new EditMessageLiveLocationRequest();
    }

    public function test_edit_message_live_location_request_can_be_instantiated_with_lat_lon()
    {
        $request = new EditMessageLiveLocationRequest(10.5, 20.5);
        $params = $request->toRequestParams();
        $this->assertEquals(10.5, $params['latitude']);
        $this->assertEquals(20.5, $params['longitude']);
    }

    public function test_edit_message_media_request_requires_media()
    {
        $this->expectException(\TypeError::class);
        // @phpstan-ignore-next-line
        new EditMessageMediaRequest();
    }

    public function test_edit_message_media_request_can_be_instantiated_with_media()
    {
        $media = new InputMediaPhoto([
            'media' => 'https://example.com/image.jpg',
            'caption' => 'Test'
        ]);
        $request = new EditMessageMediaRequest($media);
        $params = $request->toRequestParams();
        $this->assertIsString($params['media']);
        $decoded = json_decode($params['media'], true);
        $this->assertEquals('https://example.com/image.jpg', $decoded['media']);
    }
}
