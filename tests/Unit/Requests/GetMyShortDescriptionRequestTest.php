<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Requests\GetMyShortDescriptionRequest;

class GetMyShortDescriptionRequestTest extends TestCase
{
    public function test_it_serializes_to_array_correctly()
    {
        $request = new GetMyShortDescriptionRequest;
        $request->languageCode('en');

        $array = $request->toArray();

        $this->assertEquals('en', $array['language_code']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new GetMyShortDescriptionRequest;
        $this->assertEquals('getMyShortDescription', $request->getMethod());
    }
}
