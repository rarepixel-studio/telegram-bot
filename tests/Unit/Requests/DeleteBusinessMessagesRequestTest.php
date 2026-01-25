<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\DeleteBusinessMessagesRequest;

class DeleteBusinessMessagesRequestTest extends TestCase
{
    public function test_it_validates_empty_connection_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('business_connection_id cannot be empty');

        $request = new DeleteBusinessMessagesRequest('', [1]);
        $request->validate();
    }

    public function test_it_validates_empty_message_ids()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('message_ids cannot be empty');

        $request = new DeleteBusinessMessagesRequest('conn_1', []);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new DeleteBusinessMessagesRequest('conn_123', [1, 2, 3]);

        $array = $request->toArray();

        $this->assertEquals('conn_123', $array['business_connection_id']);
        $this->assertEquals([1, 2, 3], $array['message_ids']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new DeleteBusinessMessagesRequest('conn_123', [1]);
        $this->assertEquals('deleteBusinessMessages', $request->getMethod());
    }
}
