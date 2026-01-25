<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\GetUserProfilePhotosRequest;

class GetUserProfilePhotosRequestTest extends TestCase
{
    public function test_it_validates_invalid_user_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('user_id must be greater than 0');

        $request = new GetUserProfilePhotosRequest(0);
        $request->validate();
    }

    public function test_it_validates_negative_offset()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('offset must be greater than or equal to 0');

        $request = new GetUserProfilePhotosRequest(12345);
        $request->offset(-1);
        $request->validate();
    }

    public function test_it_validates_limit_too_low()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('limit must be between 1 and 100');

        $request = new GetUserProfilePhotosRequest(12345);
        $request->limit(0);
        $request->validate();
    }

    public function test_it_validates_limit_too_high()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('limit must be between 1 and 100');

        $request = new GetUserProfilePhotosRequest(12345);
        $request->limit(101);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new GetUserProfilePhotosRequest(12345);
        $request->offset(10)->limit(50);

        $array = $request->toArray();

        $this->assertEquals(12345, $array['user_id']);
        $this->assertEquals(10, $array['offset']);
        $this->assertEquals(50, $array['limit']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new GetUserProfilePhotosRequest(12345);
        $this->assertEquals('getUserProfilePhotos', $request->getMethod());
    }
}
