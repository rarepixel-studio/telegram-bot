<?php

namespace Telegram\Bot\Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Enums\ParseMode;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SendVoiceRequest;

class SendVoiceRequestTest extends TestCase
{
    public function test_it_accepts_parse_mode_enum_when_set(): void
    {
        $request = new SendVoiceRequest(123, 'voice_file_id');
        $request->parseMode(ParseMode::HTML);

        $params = $request->toArray();

        $this->assertSame('HTML', $params['parse_mode']);
    }

    public function test_it_throws_exception_when_parse_mode_is_invalid(): void
    {
        $request = new SendVoiceRequest(123, 'voice_file_id');

        $this->expectException(TelegramValidationException::class);

        $request->parseMode('InvalidMode');
    }

    public function test_it_throws_exception_when_parse_mode_and_caption_entities_are_set(): void
    {
        $request = new SendVoiceRequest(123, 'voice_file_id');
        $request->parseMode(ParseMode::HTML);
        $request->captionEntities([['type' => 'bold', 'offset' => 0, 'length' => 1]]);

        $this->expectException(TelegramValidationException::class);

        $request->validate();
    }

    public function test_it_normalizes_suggested_post_parameters_array_when_valid(): void
    {
        $sendDate = time() + 600;

        $request = new SendVoiceRequest(123, 'voice_file_id');
        $request->suggestedPostParameters(['send_date' => $sendDate]);
        $request->validate();

        $params = $request->toArray();

        $this->assertSame($sendDate, $params['suggested_post_parameters']['send_date']);
    }
}
