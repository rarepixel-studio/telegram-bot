<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class PaidMediaInfo.
 *
 * Describes the paid media added to a message.
 */
class PaidMediaInfo extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            // PaidMedia is polymorphic, will be handled by the base system
            'paid_media' => UnknownObject::class,
        ];
    }

    /**
     * The number of Telegram Stars that must be paid to buy access to the media.
     */
    public function getStarCount(): int
    {
        return $this->items['star_count'];
    }

    /**
     * Information about the paid media.
     */
    /**
     * @return Collection<int, UnknownObject>
     */
    public function getPaidMedia(): Collection
    {
        return $this->items['paid_media'];
    }
}
