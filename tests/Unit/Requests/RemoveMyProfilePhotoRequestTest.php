<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Requests\RemoveMyProfilePhotoRequest;

class RemoveMyProfilePhotoRequestTest extends TestCase
{
    public function test_it_validates_without_errors()
    {
        $request = new RemoveMyProfilePhotoRequest;
        $request->validate();

        // No exception means validation passes — all parameters are optional.
        $this->assertTrue(true);
    }

    public function test_it_serializes_to_empty_array_by_default()
    {
        $request = new RemoveMyProfilePhotoRequest;

        $array = $request->toArray();

        $this->assertEmpty($array);
    }

    public function test_it_includes_photo_id_when_set()
    {
        $request = new RemoveMyProfilePhotoRequest;
        $request->photoId('photo_abc_123');

        $array = $request->toArray();

        $this->assertEquals('photo_abc_123', $array['photo_id']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new RemoveMyProfilePhotoRequest;
        $this->assertEquals('removeMyProfilePhoto', $request->getMethod());
    }
}
