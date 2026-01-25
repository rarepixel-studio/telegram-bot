<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Requests\GetWebhookInfoRequest;

class GetWebhookInfoRequestTest extends TestCase
{
    public function test_it_serializes_to_array_correctly()
    {
        $request = new GetWebhookInfoRequest();

        $array = $request->toArray();

        $this->assertEmpty($array);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new GetWebhookInfoRequest();
        $this->assertEquals('getWebhookInfo', $request->getMethod());
    }
}
