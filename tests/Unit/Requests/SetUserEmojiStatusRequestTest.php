<?php

namespace Tests\Unit\Requests;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\Requests\SetUserEmojiStatusRequest;

class SetUserEmojiStatusRequestTest extends TestCase
{
    public function test_it_serializes_to_array_correctly()
    {
        $request = new SetUserEmojiStatusRequest(12345);
        $request->emojiStatusCustomEmojiId('custom_emoji_id_123');

        $array = $request->toArray();

        $this->assertEquals(12345, $array['user_id']);
        $this->assertEquals('custom_emoji_id_123', $array['emoji_status_custom_emoji_id']);
    }

    public function test_it_sets_optional_parameters()
    {
        $expirationDate = time() + 3600;
        $request = new SetUserEmojiStatusRequest(12345);
        $request->emojiStatusCustomEmojiId('emoji_id')
                ->emojiStatusExpirationDate($expirationDate);

        $array = $request->toArray();

        $this->assertEquals('emoji_id', $array['emoji_status_custom_emoji_id']);
        $this->assertEquals($expirationDate, $array['emoji_status_expiration_date']);
    }

    public function test_it_allows_empty_emoji_id_to_remove_status()
    {
        $request = new SetUserEmojiStatusRequest(12345);
        $request->emojiStatusCustomEmojiId('');

        $array = $request->toArray();

        $this->assertEquals('', $array['emoji_status_custom_emoji_id']);
    }

    public function test_it_returns_correct_method_name()
    {
        $request = new SetUserEmojiStatusRequest(12345);
        $this->assertEquals('setUserEmojiStatus', $request->getMethod());
    }
}
