<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SendInvoiceRequest;

class SendInvoiceRequestTest extends TestCase
{
    public function test_it_validates_empty_title()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('title cannot be empty');

        $request = new SendInvoiceRequest(123, '', 'desc', 'load', 'USD', []);
        $request->validate();
    }

    public function test_it_validates_empty_currency()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('currency cannot be empty');

        $request = new SendInvoiceRequest(123, 'title', 'desc', 'load', '', []);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new SendInvoiceRequest(123, 'title', 'desc', 'load', 'USD', [['amount' => 100]]);
        $request->providerToken('token');

        $array = $request->toArray();

        $this->assertEquals(123, $array['chat_id']);
        $this->assertEquals('title', $array['title']);
        $this->assertEquals('token', $array['provider_token']);
        $this->assertEquals(json_encode([['amount' => 100]]), $array['prices']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SendInvoiceRequest(123, 'title', 'desc', 'load', 'USD', []);
        $this->assertEquals('sendInvoice', $request->getMethod());
    }
}
