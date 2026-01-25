<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\DeleteMessagesRequest;

class DeleteMessagesRequestTest extends TestCase
{
    public function test_it_validates_empty_message_ids()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('message_ids cannot be empty');

        $request = new DeleteMessagesRequest(123, []);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new DeleteMessagesRequest(123, [456, 789]);

        $array = $request->toArray();

        $this->assertEquals(123, $array['chat_id']);
        $this->assertSame(json_encode([456, 789]), $array['message_ids']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new DeleteMessagesRequest(123, [456]);
        $this->assertEquals('deleteMessages', $request->getMethod());
    }
}
