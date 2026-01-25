<?php

namespace Telegram\Bot\Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Enums\ParseMode;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SendMessageDraftRequest;

class SendMessageDraftRequestTest extends TestCase
{
    public function test_it_creates_request_with_required_fields()
    {
        $request = new SendMessageDraftRequest(12345, 67890, 'Draft Text');
        $params = $request->toArray();

        $this->assertEquals(12345, $params['chat_id']);
        $this->assertEquals(67890, $params['draft_id']);
        $this->assertEquals('Draft Text', $params['text']);
    }

    public function test_parse_mode_accepts_enum()
    {
        $request = new SendMessageDraftRequest(12345, 67890, 'Draft Text');
        $request->setParseMode(ParseMode::HTML);

        $params = $request->toArray();

        $this->assertSame('HTML', $params['parse_mode']);
    }

    public function test_parse_mode_accepts_string()
    {
        $request = new SendMessageDraftRequest(12345, 67890, 'Draft Text');
        $request->setParseMode('MarkdownV2');

        $params = $request->toArray();

        $this->assertSame('MarkdownV2', $params['parse_mode']);
    }

    public function test_parse_mode_rejects_invalid_string()
    {
        $request = new SendMessageDraftRequest(12345, 67890, 'Draft Text');

        $this->expectException(TelegramValidationException::class);

        $request->setParseMode('InvalidMode');
    }

    public function test_parse_mode_and_entities_are_mutually_exclusive()
    {
        $request = new SendMessageDraftRequest(12345, 67890, 'Draft Text');
        $request->setParseMode(ParseMode::HTML);
        $request->setEntities([['type' => 'bold', 'offset' => 0, 'length' => 1]]);

        $this->expectException(TelegramValidationException::class);

        $request->validate();
    }
}
