<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\GetFileRequest;

class GetFileRequestTest extends TestCase
{
    public function test_it_validates_empty_file_id()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('file_id cannot be empty');

        $request = new GetFileRequest('');
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new GetFileRequest('BQACAgIAAxkBAAIBY2VnVGVy');

        $array = $request->toArray();

        $this->assertEquals('BQACAgIAAxkBAAIBY2VnVGVy', $array['file_id']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new GetFileRequest('BQACAgIAAxkBAAIBY2VnVGVy');
        $this->assertEquals('getFile', $request->getMethod());
    }
}
