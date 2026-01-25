<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Requests\GetMyCommandsRequest;

class GetMyCommandsRequestTest extends TestCase
{
    public function test_it_serializes_to_array_correctly()
    {
        $request = new GetMyCommandsRequest;
        $request->scope(['type' => 'default']);
        $request->languageCode('en');

        $array = $request->toArray();

        $this->assertSame(json_encode(['type' => 'default']), $array['scope']);
        $this->assertEquals('en', $array['language_code']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new GetMyCommandsRequest;
        $this->assertEquals('getMyCommands', $request->getMethod());
    }
}
