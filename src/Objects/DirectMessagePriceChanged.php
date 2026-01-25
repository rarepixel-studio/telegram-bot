<?php

namespace Telegram\Bot\Objects;

/**
 * Class DirectMessagePriceChanged.
 *
 * Describes a service message about a change in the price of direct messages sent to a channel chat.
 */
class DirectMessagePriceChanged extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * True, if direct messages are enabled for the channel chat.
     */
    public function getAreDirectMessagesEnabled(): bool
    {
        return $this->items['are_direct_messages_enabled'];
    }

    /**
     * (Optional). New number of Telegram Stars required for each direct message.
     */
    public function getDirectMessageStarCount(): ?int
    {
        return $this->items['direct_message_star_count'] ?? null;
    }
}
