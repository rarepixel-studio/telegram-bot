<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Requests\GetAvailableGiftsRequest;

class GetAvailableGiftsRequestTest extends TestCase
{
    public function test_it_serializes_to_array_correctly()
    {
        $request = new GetAvailableGiftsRequest;

        $array = $request->toArray();

        $this->assertEmpty($array);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new GetAvailableGiftsRequest;
        $this->assertEquals('getAvailableGifts', $request->getMethod());
    }
}
