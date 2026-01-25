<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Requests\GetBusinessAccountGiftsRequest;

class GetBusinessAccountGiftsRequestTest extends TestCase
{
    public function test_it_serializes_to_array_correctly()
    {
        $request = new GetBusinessAccountGiftsRequest('conn_123');
        $request->offset(10);
        $request->limit(50);

        $array = $request->toArray();

        $this->assertEquals('conn_123', $array['business_connection_id']);
        $this->assertEquals(10, $array['offset']);
        $this->assertEquals(50, $array['limit']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new GetBusinessAccountGiftsRequest('conn_123');
        $this->assertEquals('getBusinessAccountGifts', $request->getMethod());
    }
}
