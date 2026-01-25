<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class GiveawayWinners.
 *
 * Represents a message about the completion of a giveaway with public winners.
 */
class GiveawayWinners extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'chat' => Chat::class,
            'winners' => User::class,
        ];
    }

    /**
     * The chat that created the giveaway.
     */
    public function getChat(): Chat
    {
        return $this->items['chat'];
    }

    /**
     * Identifier of the message with the giveaway in the chat.
     */
    public function getGiveawayMessageId(): int
    {
        return $this->items['giveaway_message_id'];
    }

    /**
     * Point in time (Unix timestamp) when winners of the giveaway were selected.
     */
    public function getWinnersSelectionDate(): int
    {
        return $this->items['winners_selection_date'];
    }

    /**
     * Total number of winners in the giveaway.
     */
    public function getWinnerCount(): int
    {
        return $this->items['winner_count'];
    }

    /**
     * List of up to 100 winners of the giveaway.
     */
    /**
     * @return Collection<int, User>
     */
    public function getWinners(): Collection
    {
        return $this->items['winners'];
    }

    /**
     * (Optional). The number of other chats the user had to join in order to be eligible for the giveaway.
     */
    public function getAdditionalChatCount(): ?int
    {
        return $this->items['additional_chat_count'] ?? null;
    }

    /**
     * (Optional). The number of Telegram Stars that were split between giveaway winners.
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

    /**
     * (Optional). Number of undistributed prizes.
     */
    public function getUnclaimedPrizeCount(): ?int
    {
        return $this->items['unclaimed_prize_count'] ?? null;
    }

    /**
     * (Optional). True, if only users who had joined the chats after the giveaway started were eligible to win.
     */
    public function getOnlyNewMembers(): ?bool
    {
        return $this->items['only_new_members'] ?? null;
    }

    /**
     * (Optional). True, if the giveaway was canceled because the payment for it was refunded.
     */
    public function getWasRefunded(): ?bool
    {
        return $this->items['was_refunded'] ?? null;
    }

    /**
     * (Optional). Description of additional giveaway prize.
     */
    public function getPrizeDescription(): ?string
    {
        return $this->items['prize_description'] ?? null;
    }
}
