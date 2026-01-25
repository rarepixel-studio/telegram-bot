<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\AnswerPreCheckoutQueryRequest;

class AnswerPreCheckoutQueryRequestTest extends TestCase
{
    public function test_it_validates_empty_query_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('pre_checkout_query_id cannot be empty');

        $request = new AnswerPreCheckoutQueryRequest('', true);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new AnswerPreCheckoutQueryRequest('id', true);

        $array = $request->toArray();

        $this->assertEquals('id', $array['pre_checkout_query_id']);
        $this->assertTrue($array['ok']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new AnswerPreCheckoutQueryRequest('id', true);
        $this->assertEquals('answerPreCheckoutQuery', $request->getMethod());
    }
}
