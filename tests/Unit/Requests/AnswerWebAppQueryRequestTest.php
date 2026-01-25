<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\AnswerWebAppQueryRequest;

class AnswerWebAppQueryRequestTest extends TestCase
{
    public function test_it_validates_empty_query_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('web_app_query_id cannot be empty');

        $request = new AnswerWebAppQueryRequest('', []);
        $request->validate();
    }

    public function test_it_validates_empty_result()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('result cannot be empty');

        $request = new AnswerWebAppQueryRequest('id', []);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new AnswerWebAppQueryRequest('id', ['type' => 'article']);

        $array = $request->toArray();

        $this->assertEquals('id', $array['web_app_query_id']);
        $this->assertEquals(json_encode(['type' => 'article']), $array['result']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new AnswerWebAppQueryRequest('id', ['res']);
        $this->assertEquals('answerWebAppQuery', $request->getMethod());
    }
}
