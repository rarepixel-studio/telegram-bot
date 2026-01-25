<?php

namespace Telegram\Bot\Objects;

use Telegram\Bot\Contracts\ClientConstructibleObjectInterface;

/**
 * Class AcceptedGiftTypes.
 *
 * This object describes the types of gifts that can be gifted to a user or a chat.
 *
 * @link https://core.telegram.org/bots/api#acceptedgifttypes
 */
class AcceptedGiftTypes extends BaseObject implements ClientConstructibleObjectInterface
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Create a new instance from array data.
     *
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): static
    {
        return new static($data);
    }

    /**
     * Create an AcceptedGiftTypes instance.
     *
     * @param  array<string, mixed>  $items
     */
    public static function make($items = []): self
    {
        if (is_array($items)) {
            return new self($items);
        }

        return new self([]);
    }

    /**
     * {@inheritDoc}
     */
    public function validate(): void
    {
        // No validation rules defined for accepted gift types.
    }

    /**
     * True, if unlimited regular gifts are accepted.
     */
    public function getUnlimitedGifts(): ?bool
    {
        return $this->items['unlimited_gifts'] ?? null;
    }

    /**
     * True, if limited regular gifts are accepted.
     */
    public function getLimitedGifts(): ?bool
    {
        return $this->items['limited_gifts'] ?? null;
    }

    /**
     * True, if unique gifts or gifts that can be upgraded to unique for free are accepted.
     */
    public function getUniqueGifts(): ?bool
    {
        return $this->items['unique_gifts'] ?? null;
    }

    /**
     * True, if a Telegram Premium subscription is accepted.
     */
    public function getPremiumSubscription(): ?bool
    {
        return $this->items['premium_subscription'] ?? null;
    }
}
