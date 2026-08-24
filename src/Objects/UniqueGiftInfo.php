<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class UniqueGiftInfo.
 *
 * Describes a service message about a unique gift that was sent or received.
 */
class UniqueGiftInfo extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'gift' => UniqueGift::class,
            'entities' => MessageEntity::class,
        ];
    }

    /**
     * Information about the gift.
     */
    public function getGift(): UniqueGift
    {
        return $this->items['gift'];
    }

    /**
     * Origin of the gift.
     */
    public function getOrigin(): string
    {
        return $this->items['origin'];
    }

    /**
     * (Optional). For gifts bought from other users, the currency in which the payment for the gift was done.
     */
    public function getLastResaleCurrency(): ?string
    {
        return $this->items['last_resale_currency'] ?? null;
    }

    /**
     * (Optional). For gifts bought from other users, the price paid for the gift.
     */
    public function getLastResaleAmount(): ?int
    {
        return $this->items['last_resale_amount'] ?? null;
    }

    /**
     * (Optional). Unique identifier of the received gift for the bot.
     */
    public function getOwnedGiftId(): ?string
    {
        return $this->items['owned_gift_id'] ?? null;
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

    /**
     * (Optional). Number of Telegram Stars that must be paid to transfer the gift.
     */
    public function getTransferStarCount(): ?int
    {
        return $this->items['transfer_star_count'] ?? null;
    }

    /**
     * (Optional). Point in time (Unix timestamp) when the gift can be transferred.
     */
    public function getNextTransferDate(): ?int
    {
        return $this->items['next_transfer_date'] ?? null;
    }
}
