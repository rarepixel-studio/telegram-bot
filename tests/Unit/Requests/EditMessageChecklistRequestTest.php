<?php

namespace Telegram\Bot\Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\InlineKeyboardButton;
use Telegram\Bot\Objects\InlineKeyboardMarkup;
use Telegram\Bot\Objects\InputChecklist;
use Telegram\Bot\Requests\EditMessageChecklistRequest;

class EditMessageChecklistRequestTest extends TestCase
{
    public function test_it_creates_request_with_required_fields()
    {
        $checklist = new InputChecklist([]);
        $request = new EditMessageChecklistRequest('conn-id', 123, 456, $checklist);

        $params = $request->toArray();

        $this->assertEquals('conn-id', $params['business_connection_id']);
        $this->assertEquals(123, $params['chat_id']);
        $this->assertEquals(456, $params['message_id']);
        // Since checklist needs to be json encoded, and existing logic does that via jsonSerializedFields
        $this->assertIsString($params['checklist']);
    }

    public function test_it_validates_reply_markup_objects()
    {
        $checklist = new InputChecklist([]);
        $request = new EditMessageChecklistRequest('conn-id', 123, 456, $checklist);

        // Assuming InlineKeyboardButton needs url or callback_data etc. simple text might fail validation if strictly checked
        // But let's trigger validation failure intentionally if possible or successful one.
        // Based on other tests, 'Broken' button fails validation
        $button = InlineKeyboardButton::make('Broken');
        $markup = InlineKeyboardMarkup::make([[$button]]);

        $request->setReplyMarkup($markup);

        $this->expectException(TelegramValidationException::class);

        $request->validate();
    }

    public function test_it_normalizes_reply_markup_objects()
    {
        $checklist = new InputChecklist([]);
        $request = new EditMessageChecklistRequest('conn-id', 123, 456, $checklist);

        $button = InlineKeyboardButton::make('Visit')->withUrl('https://example.com');
        $markup = InlineKeyboardMarkup::make([[$button]]);

        $request->setReplyMarkup($markup);

        $params = $request->toArray();

        $expected = json_encode([
            'inline_keyboard' => [
                [
                    [
                        'text' => 'Visit',
                        'url' => 'https://example.com',
                    ],
                ],
            ],
        ]);

        $this->assertSame($expected, $params['reply_markup']);
    }
}
