<?php

namespace Telegram\Bot\Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Requests\GetUserGiftsRequest;

class GetUserGiftsRequestTest extends TestCase
{
    public function test_it_creates_request_with_required_fields()
    {
        $request = new GetUserGiftsRequest(12345);
        $params = $request->toArray();

        $this->assertEquals(12345, $params['user_id']);
    }

    public function test_it_sets_optional_fields()
    {
        $request = new GetUserGiftsRequest(12345);
        $request->setExcludeUnique(true);
        $request->setLimit(50);
        $request->setOffset('some-offset');

        $params = $request->toArray();

        $this->assertTrue($params['exclude_unique']);
        $this->assertEquals(50, $params['limit']);
        $this->assertEquals('some-offset', $params['offset']);
    }
}
