<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class LivePhoto.
 *
 * Represents a live photo.
 */
class LivePhoto extends BaseObject
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
     * (Optional). Available sizes of the corresponding static photo.
     *
     * @return Collection<int, PhotoSize>|null
     */
    public function getPhoto(): ?Collection
    {
        return $this->items['photo'] ?? null;
    }

    /**
     * Identifier for the video file which can be used to download or reuse the file.
     */
    public function getFileId(): string
    {
        return $this->items['file_id'];
    }

    /**
     * Unique identifier for the video file which is supposed to be the same over time and for different bots. Can't be used to download or reuse the file.
     */
    public function getFileUniqueId(): string
    {
        return $this->items['file_unique_id'];
    }

    /**
     * Video width as defined by the sender.
     */
    public function getWidth(): int
    {
        return $this->items['width'];
    }

    /**
     * Video height as defined by the sender.
     */
    public function getHeight(): int
    {
        return $this->items['height'];
    }

    /**
     * Duration of the video in seconds as defined by the sender.
     */
    public function getDuration(): int
    {
        return $this->items['duration'];
    }

    /**
     * (Optional). MIME type of the file as defined by the sender.
     */
    public function getMimeType(): ?string
    {
        return $this->items['mime_type'] ?? null;
    }

    /**
     * (Optional). File size in bytes.
     */
    public function getFileSize(): ?int
    {
        return $this->items['file_size'] ?? null;
    }
}
