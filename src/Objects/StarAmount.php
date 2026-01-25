<?php

namespace Telegram\Bot\Objects;

/**
 * Class StarAmount.
 *
 * Describes an amount of Telegram Stars.
 */
class StarAmount extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Integer amount of Telegram Stars, rounded to 0; can be negative.
     */
    public function getAmount(): int
    {
        return $this->items['amount'];
    }

    /**
     * (Optional). The number of 1/1000000000 shares of Telegram Stars.
     */
    public function getNanostarAmount(): ?int
    {
        return $this->items['nanostar_amount'] ?? null;
    }
}
