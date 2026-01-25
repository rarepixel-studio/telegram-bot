<?php

namespace Telegram\Bot\Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Enums\ParseMode;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\InputPaidMediaPhoto;
use Telegram\Bot\Requests\SendPaidMediaRequest;

class SendPaidMediaRequestTest extends TestCase
{
    public function test_it_throws_exception_when_star_count_is_out_of_range(): void
    {
        $media = [new InputPaidMediaPhoto(['media' => 'photo_file_id'])];
        $request = new SendPaidMediaRequest(123, 0, $media);

        $this->expectException(TelegramValidationException::class);

        $request->validate();
    }

    public function test_it_throws_exception_when_media_count_is_invalid(): void
    {
        $request = new SendPaidMediaRequest(123, 10, []);

        $this->expectException(TelegramValidationException::class);

        $request->validate();
    }

    public function test_it_throws_exception_when_media_item_is_invalid(): void
    {
        $request = new SendPaidMediaRequest(123, 10, [['media' => 'missing_type']]);

        $this->expectException(TelegramValidationException::class);

        $request->validate();
    }

    public function test_it_throws_exception_when_parse_mode_and_caption_entities_are_set(): void
    {
        $media = [new InputPaidMediaPhoto(['media' => 'photo_file_id'])];
        $request = new SendPaidMediaRequest(123, 10, $media);
        $request->parseMode(ParseMode::HTML);
        $request->captionEntities([['type' => 'bold', 'offset' => 0, 'length' => 1]]);

        $this->expectException(TelegramValidationException::class);

        $request->validate();
    }

    public function test_it_throws_exception_when_payload_is_too_long(): void
    {
        $media = [new InputPaidMediaPhoto(['media' => 'photo_file_id'])];
        $request = new SendPaidMediaRequest(123, 10, $media);
        $request->payload(str_repeat('a', 129));

        $this->expectException(TelegramValidationException::class);

        $request->validate();
    }

    public function test_it_keeps_input_paid_media_objects_when_building_params(): void
    {
        $media = [new InputPaidMediaPhoto(['media' => 'photo_file_id'])];
        $request = (new SendPaidMediaRequest(123, 10, $media))
            ->caption('Paid media caption')
            ->parseMode(ParseMode::HTML)
            ->showCaptionAboveMedia(true)
            ->allowPaidBroadcast(true);

        $params = $request->toArray();

        $this->assertSame(123, $params['chat_id']);
        $this->assertSame(10, $params['star_count']);
        $this->assertSame('Paid media caption', $params['caption']);
        $this->assertSame('HTML', $params['parse_mode']);
        $this->assertTrue($params['show_caption_above_media']);
        $this->assertTrue($params['allow_paid_broadcast']);
        $this->assertInstanceOf(InputPaidMediaPhoto::class, $params['media'][0]);
    }
}
