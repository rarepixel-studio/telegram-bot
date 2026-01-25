<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SendGameRequest;

class SendGameRequestTest extends TestCase
{
    public function test_it_validates_empty_short_name()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('game_short_name cannot be empty');

        $request = new SendGameRequest(123, '');
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new SendGameRequest(123, 'game');
        $request->disableNotification(true);

        $array = $request->toArray();

        $this->assertEquals(123, $array['chat_id']);
        $this->assertEquals('game', $array['game_short_name']);
        $this->assertTrue($array['disable_notification']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SendGameRequest(123, 'game');
        $this->assertEquals('sendGame', $request->getMethod());
    }
}
