<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class PaidMediaPhoto.
 *
 * The paid media is a photo.
 */
class PaidMediaPhoto extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'photo' => PhotoSize::class,
        ];
    }

    /**
     * Type of the paid media, always "photo".
     */
    public function getType(): string
    {
        return $this->items['type'];
    }

    /**
     * The photo.
     */
    /**
     * @return Collection<int, PhotoSize>
     */
    public function getPhoto(): Collection
    {
        return $this->items['photo'];
    }
}
