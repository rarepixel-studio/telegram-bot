<?php

namespace Telegram\Bot\Objects;

/**
 * Class InputPaidMediaLivePhoto.
 *
 * The paid media to send is a live photo.
 */
class InputPaidMediaLivePhoto extends InputPaidMedia
{
    /**
     * {@inheritdoc}
     */
    public function __construct(array $data)
    {
        $data['type'] = 'live_photo';
        parent::__construct($data);
    }

    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Type of the media, must be live_photo.
     */
    public function getType(): string
    {
        return 'live_photo';
    }

    /**
     * Video of the live photo to send.
     */
    public function getMedia(): string
    {
        return $this->items['media'];
    }

    /**
     * The static photo to send.
     */
    public function getPhoto(): string
    {
        return $this->items['photo'];
    }
}
