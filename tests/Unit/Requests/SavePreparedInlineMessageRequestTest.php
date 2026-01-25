<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SavePreparedInlineMessageRequest;

class SavePreparedInlineMessageRequestTest extends TestCase
{
    public function test_it_validates_invalid_user_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('user_id must be greater than 0');

        $request = new SavePreparedInlineMessageRequest(0, []);
        $request->validate();
    }

    public function test_it_validates_empty_result()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('result cannot be empty');

        $request = new SavePreparedInlineMessageRequest(123, []);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new SavePreparedInlineMessageRequest(123, ['type' => 'article']);

        $array = $request->toArray();

        $this->assertEquals(123, $array['user_id']);
        $this->assertEquals(json_encode(['type' => 'article']), $array['result']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SavePreparedInlineMessageRequest(123, ['res']);
        $this->assertEquals('savePreparedInlineMessage', $request->getMethod());
    }
}
