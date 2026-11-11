<?php

namespace Telegram\Bot\Objects;

/**
 * A custom emoji.
 *
 * @link https://core.telegram.org/bots/api#emojitypecustomemoji
 */
class EmojiTypeCustomEmoji extends EmojiType
{
    /**
     * Identifier of the custom emoji.
     */
    public function getCustomEmojiId(): string
    {
        return $this->items['custom_emoji_id'];
    }
}
