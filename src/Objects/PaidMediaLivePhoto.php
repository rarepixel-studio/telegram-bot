<?php

namespace Telegram\Bot\Objects;

/**
 * Class PaidMediaLivePhoto.
 *
 * Represents a live photo in a paid media post.
 */
class PaidMediaLivePhoto extends PaidMedia
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'live_photo' => LivePhoto::class,
        ];
    }

    /**
     * Type of the paid media, always "live_photo".
     */
    public function getType(): string
    {
        return 'live_photo';
    }

    /**
     * The photo.
     */
    public function getLivePhoto(): LivePhoto
    {
        return $this->items['live_photo'];
    }
}
