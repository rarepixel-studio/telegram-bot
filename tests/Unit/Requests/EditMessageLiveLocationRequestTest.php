<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Requests\EditMessageLiveLocationRequest;

class EditMessageLiveLocationRequestTest extends TestCase
{
    public function test_it_serializes_to_array_correctly()
    {
        $request = new EditMessageLiveLocationRequest();
        $request->chatId(123);
        $request->messageId(456);
        $request->latitude(40.7128);
        $request->longitude(-74.0060);

        $array = $request->toArray();

        $this->assertEquals(123, $array['chat_id']);
        $this->assertEquals(456, $array['message_id']);
        $this->assertEquals(40.7128, $array['latitude']);
        $this->assertEquals(-74.0060, $array['longitude']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new EditMessageLiveLocationRequest();
        $this->assertEquals('editMessageLiveLocation', $request->getMethod());
    }
}
