<?php

namespace Telegram\Bot\Objects;

/**
 * Class PaidMessagePriceChanged.
 *
 * Describes a service message about a change in the price of paid messages within a chat.
 */
class PaidMessagePriceChanged extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * New number of Telegram Stars required for each sent message.
     */
    public function getPaidMessageStarCount(): int
    {
        return $this->items['paid_message_star_count'];
    }
}
