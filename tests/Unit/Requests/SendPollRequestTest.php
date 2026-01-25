<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SendPollRequest;

class SendPollRequestTest extends TestCase
{
    public function test_it_validates_question_too_short()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Poll question must be between 1 and 300 characters');

        $request = new SendPollRequest(12345, '', ['Option 1', 'Option 2']);
        $request->validate();
    }

    public function test_it_validates_question_too_long()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Poll question must be between 1 and 300 characters');

        $request = new SendPollRequest(12345, str_repeat('a', 301), ['Option 1', 'Option 2']);
        $request->validate();
    }

    public function test_it_validates_too_few_options()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Poll must have between 2 and 10 options');

        $request = new SendPollRequest(12345, 'Question?', ['Option 1']);
        $request->validate();
    }

    public function test_it_validates_too_many_options()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Poll must have between 2 and 10 options');

        $options = array_fill(0, 11, 'Option');
        $request = new SendPollRequest(12345, 'Question?', $options);
        $request->validate();
    }

    public function test_it_validates_option_text_too_long()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Poll option at index');

        $request = new SendPollRequest(12345, 'Question?', ['Option 1', str_repeat('a', 101)]);
        $request->validate();
    }

    public function test_it_validates_invalid_poll_type()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Poll type must be either "regular" or "quiz"');

        $request = new SendPollRequest(12345, 'Question?', ['Option 1', 'Option 2']);
        $request->type('invalid');
        $request->validate();
    }

    public function test_it_validates_explanation_too_long()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Poll explanation must not exceed 200 characters');

        $request = new SendPollRequest(12345, 'Question?', ['Option 1', 'Option 2']);
        $request->explanation(str_repeat('a', 201));
        $request->validate();
    }

    public function test_it_validates_open_period_too_short()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Poll open period must be between 5 and 600 seconds');

        $request = new SendPollRequest(12345, 'Question?', ['Option 1', 'Option 2']);
        $request->openPeriod(4);
        $request->validate();
    }

    public function test_it_validates_open_period_too_long()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Poll open period must be between 5 and 600 seconds');

        $request = new SendPollRequest(12345, 'Question?', ['Option 1', 'Option 2']);
        $request->openPeriod(601);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new SendPollRequest(12345, 'What is your favorite color?', ['Red', 'Blue', 'Green']);
        $request->type('quiz')->correctOptionId(0)->explanation('Red is correct!');

        $array = $request->toArray();

        $this->assertEquals(12345, $array['chat_id']);
        $this->assertEquals('What is your favorite color?', $array['question']);
        $this->assertEquals(['Red', 'Blue', 'Green'], $array['options']);
        $this->assertEquals('quiz', $array['type']);
        $this->assertEquals(0, $array['correct_option_id']);
        $this->assertEquals('Red is correct!', $array['explanation']);
    }

    public function test_it_sets_optional_parameters()
    {
        $request = new SendPollRequest(12345, 'Question?', ['Option 1', 'Option 2']);
        $request->isAnonymous(false)
            ->allowsMultipleAnswers(true)
            ->isClosed(true);

        $array = $request->toArray();

        $this->assertFalse($array['is_anonymous']);
        $this->assertTrue($array['allows_multiple_answers']);
        $this->assertTrue($array['is_closed']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SendPollRequest(12345, 'Question?', ['Option 1', 'Option 2']);
        $this->assertEquals('sendPoll', $request->getMethod());
    }
}
