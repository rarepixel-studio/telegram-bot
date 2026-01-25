<?php

namespace Telegram\Bot\Objects;

/**
 * Class Gift.
 *
 * Represents a gift that can be sent by the bot.
 */
class Gift extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'sticker' => Sticker::class,
            'publisher_chat' => Chat::class,
        ];
    }

    /**
     * (Optional). Unique identifier of the gift.
     */
    public function getId(): ?string
    {
        return $this->items['id'] ?? null;
    }

    /**
     * The sticker that represents the gift.
     */
    public function getSticker(): Sticker
    {
        return $this->items['sticker'];
    }

    /**
     * The number of Telegram Stars that must be paid to send the sticker.
     */
    public function getStarCount(): int
    {
        return $this->items['star_count'];
    }

    /**
     * (Optional). The number of Telegram Stars that must be paid to upgrade the gift to a unique one.
     */
    public function getUpgradeStarCount(): ?int
    {
        return $this->items['upgrade_star_count'] ?? null;
    }

    /**
     * (Optional). The total number of the gifts of this type that can be sent; for limited gifts only.
     */
    public function getTotalCount(): ?int
    {
        return $this->items['total_count'] ?? null;
    }

    /**
     * (Optional). The number of remaining gifts of this type that can be sent; for limited gifts only.
     */
    public function getRemainingCount(): ?int
    {
        return $this->items['remaining_count'] ?? null;
    }

    /**
     * (Optional). Information about the chat that published the gift.
     */
    public function getPublisherChat(): ?Chat
    {
        return $this->items['publisher_chat'] ?? null;
    }
}
