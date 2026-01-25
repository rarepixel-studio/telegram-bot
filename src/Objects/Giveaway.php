<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class Giveaway.
 *
 * Represents a message about a scheduled giveaway.
 */
class Giveaway extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'chats' => Chat::class,
        ];
    }

    /**
     * The list of chats which the user must join to participate in the giveaway.
     */
    /**
     * @return Collection<int, Chat>
     */
    public function getChats(): Collection
    {
        return $this->items['chats'];
    }

    /**
     * Point in time (Unix timestamp) when winners of the giveaway will be selected.
     */
    public function getWinnersSelectionDate(): int
    {
        return $this->items['winners_selection_date'];
    }

    /**
     * The number of users which are supposed to be selected as winners of the giveaway.
     */
    public function getWinnerCount(): int
    {
        return $this->items['winner_count'];
    }

    /**
     * (Optional). True, if only users who join the chats after the giveaway started should be eligible to win.
     */
    public function getOnlyNewMembers(): ?bool
    {
        return $this->items['only_new_members'] ?? null;
    }

    /**
     * (Optional). True, if the list of giveaway winners will be visible to everyone.
     */
    public function getHasPublicWinners(): ?bool
    {
        return $this->items['has_public_winners'] ?? null;
    }

    /**
     * (Optional). Description of additional giveaway prize.
     */
    public function getPrizeDescription(): ?string
    {
        return $this->items['prize_description'] ?? null;
    }

    /**
     * (Optional). A list of two-letter ISO 3166-1 alpha-2 country codes indicating the countries from which eligible users for the giveaway must come.
     */
    public function getCountryCodes(): ?array
    {
        return $this->items['country_codes'] ?? null;
    }

    /**
     * (Optional). The number of Telegram Stars to be split between giveaway winners.
     */
    public function getPrizeStarCount(): ?int
    {
        return $this->items['prize_star_count'] ?? null;
    }

    /**
     * (Optional). The number of months the Telegram Premium subscription won from the giveaway will be active for.
     */
    public function getPremiumSubscriptionMonthCount(): ?int
    {
        return $this->items['premium_subscription_month_count'] ?? null;
    }
}
