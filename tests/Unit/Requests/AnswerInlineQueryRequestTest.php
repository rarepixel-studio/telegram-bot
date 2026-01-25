<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\AnswerInlineQueryRequest;

class AnswerInlineQueryRequestTest extends TestCase
{
    public function test_it_validates_empty_query_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('inline_query_id cannot be empty');

        $request = new AnswerInlineQueryRequest('', []);
        $request->validate();
    }

    public function test_it_validates_empty_results()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('results cannot be empty');

        $request = new AnswerInlineQueryRequest('id', []);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new AnswerInlineQueryRequest('id', [['id' => 1]]);

        $array = $request->toArray();

        $this->assertEquals('id', $array['inline_query_id']);
        $this->assertEquals(json_encode([['id' => 1]]), $array['results']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new AnswerInlineQueryRequest('id', ['results']);
        $this->assertEquals('answerInlineQuery', $request->getMethod());
    }
}
