<?php

namespace Telegram\Bot\Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Requests\RepostStoryRequest;

class RepostStoryRequestTest extends TestCase
{
    public function test_it_creates_request_with_required_fields()
    {
        $request = new RepostStoryRequest('conn-id', 111, 222, 3600);
        $params = $request->toArray();

        $this->assertEquals('conn-id', $params['business_connection_id']);
        $this->assertEquals(111, $params['from_chat_id']);
        $this->assertEquals(222, $params['from_story_id']);
        $this->assertEquals(3600, $params['active_period']);
    }

    public function test_it_sets_optional_fields()
    {
        $request = new RepostStoryRequest('conn-id', 111, 222, 3600);
        $request->setPostToChatPage(true);
        $request->setProtectContent(true);

        $params = $request->toArray();

        $this->assertTrue($params['post_to_chat_page']);
        $this->assertTrue($params['protect_content']);
    }
}
