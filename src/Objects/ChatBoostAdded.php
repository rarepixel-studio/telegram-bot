<?php

namespace Telegram\Bot\Objects;

/**
 * Class ChatBoostAdded.
 *
 * Represents a service message about a user boosting a chat.
 */
class ChatBoostAdded extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Number of boosts added by the user.
     */
    public function getBoostCount(): int
    {
        return $this->items['boost_count'];
    }
}
