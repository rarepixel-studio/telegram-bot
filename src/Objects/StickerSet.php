<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class StickerSet.
 *
 * This object represents a sticker set.
 */
class StickerSet extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'stickers' => Sticker::class,
            'thumbnail' => PhotoSize::class,
        ];
    }

    /**
     * Sticker set name.
     */
    public function getName(): string
    {
        return $this->items['name'];
    }

    /**
     * Sticker set title.
     */
    public function getTitle(): string
    {
        return $this->items['title'];
    }

    /**
     * Type of stickers in the set.
     */
    public function getStickerType(): string
    {
        return $this->items['sticker_type'];
    }

    /**
     * True, if the sticker set contains animated stickers.
     */
    public function getIsAnimated(): bool
    {
        return $this->items['is_animated'];
    }

    /**
     * True, if the sticker set contains video stickers.
     */
    public function getIsVideo(): bool
    {
        return $this->items['is_video'];
    }

    /**
     * List of all set stickers.
     *
     * @return Collection<int, Sticker>
     */
    public function getStickers(): Collection
    {
        return $this->items['stickers'];
    }

    /**
     * (Optional). Sticker set thumbnail.
     */
    public function getThumbnail(): ?PhotoSize
    {
        return $this->items['thumbnail'] ?? null;
    }
}
