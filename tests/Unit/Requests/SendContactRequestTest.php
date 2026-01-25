<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SendContactRequest;

class SendContactRequestTest extends TestCase
{
    public function test_it_validates_empty_first_name()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('First name cannot be empty');

        $request = new SendContactRequest(12345, '+1234567890', '');
        $request->validate();
    }

    public function test_it_validates_empty_phone_number()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Phone number cannot be empty');

        $request = new SendContactRequest(12345, '', 'John');
        $request->validate();
    }

    public function test_it_validates_vcard_length()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('vCard must not exceed 2048 bytes');

        $request = new SendContactRequest(12345, '+1234567890', 'John');
        $request->vcard(str_repeat('a', 2049));
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly()
    {
        $request = new SendContactRequest(12345, '+1234567890', 'John');
        $request->lastName('Doe')->vcard('BEGIN:VCARD...');

        $array = $request->toArray();

        $this->assertEquals(12345, $array['chat_id']);
        $this->assertEquals('+1234567890', $array['phone_number']);
        $this->assertEquals('John', $array['first_name']);
        $this->assertEquals('Doe', $array['last_name']);
        $this->assertEquals('BEGIN:VCARD...', $array['vcard']);
    }

    public function test_it_sets_optional_parameters()
    {
        $request = new SendContactRequest(12345, '+1234567890', 'John');
        $request->messageThreadId(10)
            ->disableNotification(true)
            ->protectContent(true);

        $array = $request->toArray();

        $this->assertEquals(10, $array['message_thread_id']);
        $this->assertTrue($array['disable_notification']);
        $this->assertTrue($array['protect_content']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SendContactRequest(12345, '+1234567890', 'John');
        $this->assertEquals('sendContact', $request->getMethod());
    }
}
