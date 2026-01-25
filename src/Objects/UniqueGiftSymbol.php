<?php

namespace Telegram\Bot\Objects;

/**
 * Class UniqueGiftSymbol.
 *
 * Describes the symbol shown on the pattern of a unique gift.
 */
class UniqueGiftSymbol extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'sticker' => Sticker::class,
        ];
    }

    /**
     * Name of the symbol.
     */
    public function getName(): string
    {
        return $this->items['name'];
    }

    /**
     * The sticker that represents the unique gift.
     */
    public function getSticker(): Sticker
    {
        return $this->items['sticker'];
    }

    /**
     * The number of unique gifts that receive this symbol for every 1000 gifts upgraded.
     */
    public function getRarityPerMille(): int
    {
        return $this->items['rarity_per_mille'];
    }
}
