<?php

namespace Telegram\Bot\Objects;

/**
 * Class ChatBoostSource.
 *
 * This object describes the source of a chat boost. It can be one of:
 * - ChatBoostSourcePremium
 * - ChatBoostSourceGiftCode
 * - ChatBoostSourceGiveaway
 *
 * @link https://core.telegram.org/bots/api#chatboostsource
 */
class ChatBoostSource extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'user' => User::class,
        ];
    }

    /**
     * Source of the boost, always "premium", "gift_code", or "giveaway".
     */
    public function getSource(): string
    {
        return $this->items['source'];
    }

    /**
     * (Optional). User that boosted the chat.
     */
    public function getUser(): ?User
    {
        return $this->items['user'] ?? null;
    }

    /**
     * (Optional). Identifier of a message in the chat with the giveaway; the message could have been deleted already. May be 0 if the message isn't sent yet.
     * Only for "giveaway" source.
     */
    public function getGiveawayMessageId(): ?int
    {
        return $this->items['giveaway_message_id'] ?? null;
    }

    /**
     * (Optional). The number of Telegram Stars to be split between giveaway winners; for Telegram Star giveaways only.
     * Only for "giveaway" source.
     */
    public function getPrizeStarCount(): ?int
    {
        return $this->items['prize_star_count'] ?? null;
    }

    /**
     * (Optional). True, if the giveaway was completed, but there was no user to win the prize.
     * Only for "giveaway" source.
     */
    public function getIsUnclaimed(): ?bool
    {
        return $this->items['is_unclaimed'] ?? null;
    }
}
