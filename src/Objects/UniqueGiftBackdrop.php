<?php

namespace Telegram\Bot\Objects;

/**
 * Class UniqueGiftBackdrop.
 *
 * Describes the backdrop of a unique gift.
 */
class UniqueGiftBackdrop extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'colors' => UniqueGiftBackdropColors::class,
        ];
    }

    /**
     * Name of the backdrop.
     */
    public function getName(): string
    {
        return $this->items['name'];
    }

    /**
     * Colors of the backdrop.
     */
    public function getColors(): UniqueGiftBackdropColors
    {
        return $this->items['colors'];
    }

    /**
     * The number of unique gifts that receive this backdrop for every 1000 gifts upgraded.
     */
    public function getRarityPerMille(): int
    {
        return $this->items['rarity_per_mille'];
    }
}
