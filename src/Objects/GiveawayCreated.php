<?php

namespace Telegram\Bot\Objects;

/**
 * Class GiveawayCreated.
 *
 * Represents a service message about a scheduled giveaway was created.
 */
class GiveawayCreated extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * (Optional). The number of Telegram Stars to be split between giveaway winners.
     */
    public function getPrizeStarCount(): ?int
    {
        return $this->items['prize_star_count'] ?? null;
    }
}
