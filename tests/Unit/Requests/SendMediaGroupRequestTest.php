<?php

namespace Telegram\Bot\Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\InputMediaPhoto;
use Telegram\Bot\Objects\InputMediaVideo;
use Telegram\Bot\Requests\SendMediaGroupRequest;

class SendMediaGroupRequestTest extends TestCase
{
    /** @test */
    public function it_creates_a_valid_request()
    {
        $media = [
            new InputMediaPhoto(['media' => 'photo1.jpg', 'caption' => 'Photo 1']),
            new InputMediaVideo(['media' => 'video1.mp4', 'caption' => 'Video 1']),
        ];

        $request = new SendMediaGroupRequest(123456, $media);

        $params = $request->toArray();
        $this->assertEquals(123456, $params['chat_id']);
        $this->assertCount(2, $params['media']);
        $this->assertInstanceOf(InputMediaPhoto::class, $params['media'][0]);
        $this->assertInstanceOf(InputMediaVideo::class, $params['media'][1]);
    }

    /** @test */
    public function it_validates_min_media_items()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Media array must include at least 2 items');

        $request = new SendMediaGroupRequest(123456, [
            new InputMediaPhoto(['media' => 'photo1.jpg']),
        ]);

        $request->validate();
    }

    /** @test */
    public function it_validates_max_media_items()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Media array must not exceed 10 items');

        $media = [];
        for ($i = 0; $i < 11; $i++) {
            $media[] = new InputMediaPhoto(['media' => "photo{$i}.jpg"]);
        }

        $request = new SendMediaGroupRequest(123456, $media);

        $request->validate();
    }

    /** @test */
    public function it_validates_media_item_types()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('Media item at index 0 must be an InputMediaPhoto, InputMediaVideo, InputMediaLivePhoto, InputMediaAudio, InputMediaDocument, or array');

        $request = new SendMediaGroupRequest(123456, [
            'invalid_item',
            new InputMediaPhoto(['media' => 'photo1.jpg']),
        ]);

        $request->validate();
    }

    /** @test */
    public function it_normalizes_array_media_items()
    {
        $media = [
            ['type' => 'photo', 'media' => 'photo1.jpg'],
            ['type' => 'video', 'media' => 'video1.mp4'],
        ];

        $request = new SendMediaGroupRequest(123456, $media);
        $request->validate(); // Validation triggers normalization

        $params = $request->toArray();
        $this->assertInstanceOf(InputMediaPhoto::class, $params['media'][0]);
        $this->assertInstanceOf(InputMediaVideo::class, $params['media'][1]);
    }

    /** @test */
    public function it_sets_optional_parameters()
    {
        $media = [
            new InputMediaPhoto(['media' => 'photo1.jpg']),
            new InputMediaPhoto(['media' => 'photo2.jpg']),
        ];

        $request = (new SendMediaGroupRequest(123456, $media))
            ->disableNotification(true)
            ->protectContent(true)
            ->messageThreadId(789)
            ->businessConnectionId('biz_123');

        $params = $request->toArray();

        $this->assertTrue($params['disable_notification']);
        $this->assertTrue($params['protect_content']);
        $this->assertEquals(789, $params['message_thread_id']);
        $this->assertEquals('biz_123', $params['business_connection_id']);
    }
}
