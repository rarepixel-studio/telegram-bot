<?php

namespace Telegram\Bot\Objects;

/**
 * Class GiveawayCompleted.
 *
 * Represents a service message about the completion of a giveaway without public winners.
 */
class GiveawayCompleted extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'giveaway_message' => Message::class,
        ];
    }

    /**
     * Number of winners in the giveaway.
     */
    public function getWinnerCount(): int
    {
        return $this->items['winner_count'];
    }

    /**
     * (Optional). Number of undistributed prizes.
     */
    public function getUnclaimedPrizeCount(): ?int
    {
        return $this->items['unclaimed_prize_count'] ?? null;
    }

    /**
     * (Optional). Message with the giveaway that was completed, if it wasn't deleted.
     */
    public function getGiveawayMessage(): ?Message
    {
        return $this->items['giveaway_message'] ?? null;
    }

    /**
     * (Optional). True, if the giveaway is a Telegram Star giveaway.
     */
    public function getIsStarGiveaway(): ?bool
    {
        return $this->items['is_star_giveaway'] ?? null;
    }
}
