<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Requests\EditMessageTextRequest;

class EditMessageTextRequestTest extends TestCase
{
    public function test_it_serializes_to_array_correctly()
    {
        $request = new EditMessageTextRequest('Updated text');
        $request->chatId(123);
        $request->messageId(456);
        $request->text('Updated text');

        $array = $request->toArray();

        $this->assertEquals(123, $array['chat_id']);
        $this->assertEquals(456, $array['message_id']);
        $this->assertEquals('Updated text', $array['text']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new EditMessageTextRequest('Updated text');
        $this->assertEquals('editMessageText', $request->getMethod());
    }
}
