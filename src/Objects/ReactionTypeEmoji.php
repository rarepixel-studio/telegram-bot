<?php

namespace Telegram\Bot\Objects;

/**
 * Class ReactionTypeEmoji.
 *
 * The reaction is based on an emoji.
 */
class ReactionTypeEmoji extends ReactionType
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Reaction emoji.
     */
    public function getEmoji(): string
    {
        return $this->items['emoji'];
    }
}
