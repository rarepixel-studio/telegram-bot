<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class Gifts.
 *
 * Represents a list of gifts.
 */
class Gifts extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'gifts' => Gift::class,
        ];
    }

    /**
     * The list of gifts.
     */
    /**
     * @return Collection<int, Gift>
     */
    public function getGifts(): Collection
    {
        return $this->items['gifts'];
    }
}
