<?php

namespace Telegram\Bot\Objects;

/**
 * Class PaidMediaVideo.
 *
 * The paid media is a video.
 */
class PaidMediaVideo extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'video' => Video::class,
        ];
    }

    /**
     * Type of the paid media, always "video".
     */
    public function getType(): string
    {
        return $this->items['type'];
    }

    /**
     * The video.
     */
    public function getVideo(): Video
    {
        return $this->items['video'];
    }
}
