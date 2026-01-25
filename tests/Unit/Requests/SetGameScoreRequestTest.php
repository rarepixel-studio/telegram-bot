<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SetGameScoreRequest;

class SetGameScoreRequestTest extends TestCase
{
    public function test_it_validates_invalid_user_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('user_id must be greater than 0');

        $request = new SetGameScoreRequest(0, 100);
        $request->validate();
    }

    public function test_it_validates_negative_score()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('score must be non-negative');

        $request = new SetGameScoreRequest(123, -1);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new SetGameScoreRequest(123, 100);
        $request->force(true);

        $array = $request->toArray();

        $this->assertEquals(123, $array['user_id']);
        $this->assertEquals(100, $array['score']);
        $this->assertTrue($array['force']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SetGameScoreRequest(123, 100);
        $this->assertEquals('setGameScore', $request->getMethod());
    }
}
