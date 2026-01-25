<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SetPassportDataErrorsRequest;

class SetPassportDataErrorsRequestTest extends TestCase
{
    public function test_it_validates_invalid_user_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('user_id must be greater than 0');

        $request = new SetPassportDataErrorsRequest(0, []);
        $request->validate();
    }

    public function test_it_validates_empty_errors()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('errors cannot be empty');

        $request = new SetPassportDataErrorsRequest(123, []);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new SetPassportDataErrorsRequest(123, [['error' => 'data']]);

        $array = $request->toArray();

        $this->assertEquals(123, $array['user_id']);
        $this->assertEquals(json_encode([['error' => 'data']]), $array['errors']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SetPassportDataErrorsRequest(123, ['errors']);
        $this->assertEquals('setPassportDataErrors', $request->getMethod());
    }
}
