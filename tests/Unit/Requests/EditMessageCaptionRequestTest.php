<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Requests\EditMessageCaptionRequest;

class EditMessageCaptionRequestTest extends TestCase
{
    public function test_it_serializes_to_array_correctly()
    {
        $request = new EditMessageCaptionRequest();
        $request->inlineMessageId('inline_123');
        $request->caption('Updated caption');

        $array = $request->toArray();

        $this->assertEquals('inline_123', $array['inline_message_id']);
        $this->assertEquals('Updated caption', $array['caption']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new EditMessageCaptionRequest();
        $this->assertEquals('editMessageCaption', $request->getMethod());
    }
}
