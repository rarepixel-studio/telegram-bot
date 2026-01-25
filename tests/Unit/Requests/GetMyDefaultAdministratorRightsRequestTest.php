<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Requests\GetMyDefaultAdministratorRightsRequest;

class GetMyDefaultAdministratorRightsRequestTest extends TestCase
{
    public function test_it_serializes_to_array_correctly()
    {
        $request = new GetMyDefaultAdministratorRightsRequest;
        $request->forChannels(true);

        $array = $request->toArray();

        $this->assertTrue($array['for_channels']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new GetMyDefaultAdministratorRightsRequest;
        $this->assertEquals('getMyDefaultAdministratorRights', $request->getMethod());
    }
}
