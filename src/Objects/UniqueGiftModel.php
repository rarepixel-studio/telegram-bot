<?php

namespace Telegram\Bot\Objects;

/**
 * Class UniqueGiftModel.
 *
 * Describes the model of a unique gift.
 */
class UniqueGiftModel extends BaseObject
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
     * Name of the model.
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
     * The number of unique gifts that receive this model for every 1000 gifts upgraded.
     */
    public function getRarityPerMille(): int
    {
        return $this->items['rarity_per_mille'];
    }

    /**
     * (Optional). The rarity of the model as a textual description (e.g., "common", "rare").
     */
    public function getRarity(): ?string
    {
        return $this->items['rarity'] ?? null;
    }
}
