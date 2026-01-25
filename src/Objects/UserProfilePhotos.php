<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class UserProfilePhotos. *
 */
class UserProfilePhotos extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'photos' => PhotoSize::class,
        ];
    }

    /**
     * Total number of profile pictures the target user has.
     */
    public function getTotalCount(): int
    {
        return $this->items['total_count'];
    }

    /**
     * Requested profile pictures (in up to 4 sizes each).
     */
    /**
     * @return Collection<int, PhotoSize>
     */
    public function getPhotos(): Collection
    {
        return $this->items['photos'];
    }
}
