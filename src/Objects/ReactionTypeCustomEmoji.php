<?php

namespace Telegram\Bot\Objects;

/**
 * Class ReactionTypeCustomEmoji.
 *
 * The reaction is based on a custom emoji.
 */
class ReactionTypeCustomEmoji extends ReactionType
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Custom emoji identifier.
     */
    public function getCustomEmojiId(): string
    {
        return $this->items['custom_emoji_id'];
    }
}
