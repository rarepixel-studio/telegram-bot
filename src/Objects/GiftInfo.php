<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class GiftInfo.
 *
 * Describes a service message about a regular gift that was sent or received.
 */
class GiftInfo extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'gift' => Gift::class,
            'entities' => MessageEntity::class,
        ];
    }

    /**
     * Information about the gift.
     */
    public function getGift(): Gift
    {
        return $this->items['gift'];
    }

    /**
     * (Optional). Unique identifier of the received gift for the bot; only present for gifts received on behalf of business accounts.
     */
    public function getOwnedGiftId(): ?string
    {
        return $this->items['owned_gift_id'] ?? null;
    }

    /**
     * (Optional). Number of Telegram Stars that can be claimed by the receiver by converting the gift.
     */
    public function getConvertStarCount(): ?int
    {
        return $this->items['convert_star_count'] ?? null;
    }

    /**
     * (Optional). Number of Telegram Stars that were prepaid by the sender for the ability to upgrade the gift.
     */
    public function getPrepaidUpgradeStarCount(): ?int
    {
        return $this->items['prepaid_upgrade_star_count'] ?? null;
    }

    /**
     * (Optional). True, if the gift can be upgraded to a unique gift.
     */
    public function getCanBeUpgraded(): ?bool
    {
        return $this->items['can_be_upgraded'] ?? null;
    }

    /**
     * (Optional). Text of the message that was added to the gift.
     */
    public function getText(): ?string
    {
        return $this->items['text'] ?? null;
    }

    /**
     * @return Collection<int, MessageEntity>|null
     */
    public function getEntities(): ?Collection
    {
        return $this->items['entities'] ?? null;
    }

    /**
     * (Optional). True, if the sender and gift text are shown only to the gift receiver.
     */
    public function getIsPrivate(): ?bool
    {
        return $this->items['is_private'] ?? null;
    }
}
