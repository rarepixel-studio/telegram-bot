<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class PollMedia.
 *
 * This object describes media added to a poll or its explanation.
 */
class PollMedia extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'animation' => Animation::class,
            'audio' => Audio::class,
            'document' => Document::class,
            'link' => Link::class,
            'live_photo' => LivePhoto::class,
            'location' => Location::class,
            'photo' => PhotoSize::class,
            'sticker' => Sticker::class,
            'venue' => Venue::class,
            'video' => Video::class,
        ];
    }

    /**
     * (Optional). Media is an animation, information about the animation.
     */
    public function getAnimation(): ?Animation
    {
        return $this->items['animation'] ?? null;
    }

    /**
     * (Optional). Media is an audio file, information about the file.
     */
    public function getAudio(): ?Audio
    {
        return $this->items['audio'] ?? null;
    }

    /**
     * (Optional). Media is a general file, information about the file.
     */
    public function getDocument(): ?Document
    {
        return $this->items['document'] ?? null;
    }

    /**
     * (Optional). The HTTP link attached to the poll option.
     */
    public function getLink(): ?Link
    {
        return $this->items['link'] ?? null;
    }

    /**
     * (Optional). Media is a live photo, information about the live photo.
     */
    public function getLivePhoto(): ?LivePhoto
    {
        return $this->items['live_photo'] ?? null;
    }

    /**
     * (Optional). Media is a shared location, information about the location.
     */
    public function getLocation(): ?Location
    {
        return $this->items['location'] ?? null;
    }

    /**
     * (Optional). Media is a photo, available sizes of the photo.
     *
     * @return Collection<int, PhotoSize>|null
     */
    public function getPhoto(): ?Collection
    {
        return $this->items['photo'] ?? null;
    }

    /**
     * (Optional). Media is a sticker, information about the sticker.
     */
    public function getSticker(): ?Sticker
    {
        return $this->items['sticker'] ?? null;
    }

    /**
     * (Optional). Media is a venue, information about the venue.
     */
    public function getVenue(): ?Venue
    {
        return $this->items['venue'] ?? null;
    }

    /**
     * (Optional). Media is a video, information about the video.
     */
    public function getVideo(): ?Video
    {
        return $this->items['video'] ?? null;
    }
}
