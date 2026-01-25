<?php

namespace Telegram\Bot\Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Requests\GetChatGiftsRequest;

class GetChatGiftsRequestTest extends TestCase
{
    public function test_it_creates_request_with_required_fields()
    {
        $request = new GetChatGiftsRequest(12345);
        $params = $request->toArray();

        $this->assertEquals(12345, $params['chat_id']);
    }

    public function test_it_sets_optional_fields()
    {
        $request = new GetChatGiftsRequest(12345);
        $request->setExcludeSaved(true);
        $request->setLimit(10);

        $params = $request->toArray();

        $this->assertTrue($params['exclude_saved']);
        $this->assertEquals(10, $params['limit']);
    }

    public function test_it_accepts_string_chat_id()
    {
        $request = new GetChatGiftsRequest('@username');
        $params = $request->toArray();

        $this->assertEquals('@username', $params['chat_id']);
    }
}
