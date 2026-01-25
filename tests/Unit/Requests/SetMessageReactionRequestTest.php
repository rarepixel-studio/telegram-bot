<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SetMessageReactionRequest;

class SetMessageReactionRequestTest extends TestCase
{
    public function test_it_validates_invalid_message_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('message_id must be greater than 0');

        $request = new SetMessageReactionRequest(12345, 0);
        $request->validate();
    }

    public function test_it_validates_negative_message_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('message_id must be greater than 0');

        $request = new SetMessageReactionRequest(12345, -5);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new SetMessageReactionRequest(12345, 100);
        $request->reaction([['type' => 'emoji', 'emoji' => '👍']]);

        $array = $request->toArray();

        $this->assertEquals(12345, $array['chat_id']);
        $this->assertEquals(100, $array['message_id']);
        $this->assertIsString($array['reaction']);
        $this->assertSame(json_encode([['type' => 'emoji', 'emoji' => '👍']]), $array['reaction']);
    }

    public function test_it_sets_optional_parameters()
    {
        $request = new SetMessageReactionRequest(12345, 100);
        $request->isBig(true);

        $array = $request->toArray();

        $this->assertTrue($array['is_big']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SetMessageReactionRequest(12345, 100);
        $this->assertEquals('setMessageReaction', $request->getMethod());
    }
}
