<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\CreateInvoiceLinkRequest;

class CreateInvoiceLinkRequestTest extends TestCase
{
    public function test_it_validates_empty_title()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('title cannot be empty');

        $request = new CreateInvoiceLinkRequest('', 'desc', 'load', 'USD', []);
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new CreateInvoiceLinkRequest('title', 'desc', 'load', 'USD', []);

        $array = $request->toArray();

        $this->assertEquals('title', $array['title']);
        $this->assertEquals('USD', $array['currency']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new CreateInvoiceLinkRequest('title', 'desc', 'load', 'USD', []);
        $this->assertEquals('createInvoiceLink', $request->getMethod());
    }
}
