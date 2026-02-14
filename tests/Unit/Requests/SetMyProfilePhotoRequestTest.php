<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\SetMyProfilePhotoRequest;

class SetMyProfilePhotoRequestTest extends TestCase
{
    public function test_it_validates_empty_photo()
    {
        $this->expectException(TelegramValidationException::class);
        $this->expectExceptionMessage('photo is required');

        $request = new SetMyProfilePhotoRequest('');
        $request->validate();
    }

    public function test_it_serializes_to_array_correctly_with_array_photo()
    {
        $request = new SetMyProfilePhotoRequest(['type' => 'static', 'photo' => 'file_id_123']);

        $array = $request->toArray();

        $this->assertEquals(json_encode(['type' => 'static', 'photo' => 'file_id_123']), $array['photo']);
    }

    public function test_it_serializes_to_array_correctly_with_string_photo()
    {
        $photoJson = json_encode(['type' => 'static', 'photo' => 'file_id_123']);
        $request = new SetMyProfilePhotoRequest($photoJson);

        $array = $request->toArray();

        $this->assertEquals($photoJson, $array['photo']);
    }

    public function test_it_includes_is_public_when_set()
    {
        $request = new SetMyProfilePhotoRequest(['type' => 'static', 'photo' => 'file_id_123']);
        $request->isPublic(true);

        $array = $request->toArray();

        $this->assertTrue($array['is_public']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SetMyProfilePhotoRequest(['type' => 'static', 'photo' => 'file_id_123']);
        $this->assertEquals('setMyProfilePhoto', $request->getMethod());
    }
}
