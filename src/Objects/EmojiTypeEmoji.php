<?php

namespace Telegram\Bot\Objects;

/**
 * A regular emoji.
 *
 * @link https://core.telegram.org/bots/api#emojitypeemoji
 */
class EmojiTypeEmoji extends EmojiType
{
    /**
     * The emoji.
     */
    public function getEmoji(): string
    {
        return $this->items['emoji'];
    }
}
