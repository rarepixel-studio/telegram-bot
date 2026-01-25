<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Requests\SetMyDefaultAdministratorRightsRequest;

class SetMyDefaultAdministratorRightsRequestTest extends TestCase
{
    public function test_it_serializes_to_array_correctly()
    {
        $request = new SetMyDefaultAdministratorRightsRequest;
        $request->rights(['is_anonymous' => true]);
        $request->forChannels(true);

        $array = $request->toArray();

        $this->assertSame(json_encode(['is_anonymous' => true]), $array['rights']);
        $this->assertTrue($array['for_channels']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SetMyDefaultAdministratorRightsRequest;
        $this->assertEquals('setMyDefaultAdministratorRights', $request->getMethod());
    }
}
