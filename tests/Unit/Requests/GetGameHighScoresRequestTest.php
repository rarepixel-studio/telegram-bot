<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\GetGameHighScoresRequest;

class GetGameHighScoresRequestTest extends TestCase
{
    public function test_it_validates_invalid_user_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('user_id must be greater than 0');

        $request = new GetGameHighScoresRequest(0);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new GetGameHighScoresRequest(123);
        $request->chatId(456);
        $request->messageId(789);

        $array = $request->toArray();

        $this->assertEquals(123, $array['user_id']);
        $this->assertEquals(456, $array['chat_id']);
        $this->assertEquals(789, $array['message_id']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new GetGameHighScoresRequest(123);
        $this->assertEquals('getGameHighScores', $request->getMethod());
    }
}
