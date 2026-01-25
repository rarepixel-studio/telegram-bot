<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\AnswerShippingQueryRequest;

class AnswerShippingQueryRequestTest extends TestCase
{
    public function test_it_validates_empty_query_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('shipping_query_id cannot be empty');

        $request = new AnswerShippingQueryRequest('', true);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new AnswerShippingQueryRequest('id', true);
        $request->errorMessage('error');

        $array = $request->toArray();

        $this->assertEquals('id', $array['shipping_query_id']);
        $this->assertTrue($array['ok']);
        $this->assertEquals('error', $array['error_message']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new AnswerShippingQueryRequest('id', true);
        $this->assertEquals('answerShippingQuery', $request->getMethod());
    }
}
