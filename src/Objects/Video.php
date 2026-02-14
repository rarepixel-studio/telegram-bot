<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class Video. *
 */
class Video extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'thumb' => PhotoSize::class,
            'thumbnail' => PhotoSize::class,
            'cover' => PhotoSize::class,
            'qualities' => VideoQuality::class,
        ];
    }

    /**
     * Unique identifier for this file.
     */
    public function getFileId(): string
    {
        return $this->items['file_id'];
    }

    /**
     * Unique identifier for this file, which is supposed to be the same over time
     * and for different bots. Can't be used to download or reuse the file.
     */
    public function getFileUniqueId(): string
    {
        return $this->items['file_unique_id'];
    }

    /**
     * Video width as defined by sender.
     */
    public function getWidth(): int
    {
        return $this->items['width'];
    }

    /**
     * Video height as defined by sender.
     */
    public function getHeight(): int
    {
        return $this->items['height'];
    }

    /**
     * Duration of the video in seconds as defined by sender.
     */
    public function getDuration(): int
    {
        return $this->items['duration'];
    }

    /**
     * (Optional). Video thumbnail.
     *
     * @deprecated Use getThumbnail() instead
     */
    public function getThumb(): ?PhotoSize
    {
        return $this->items['thumb'] ?? null;
    }

    /**
     * (Optional). Video thumbnail.
     */
    public function getThumbnail(): ?PhotoSize
    {
        return $this->items['thumbnail'] ?? null;
    }

    /**
     * (Optional). Available sizes of the video cover (preview of the video in the message).
     *
     * @return Collection<int, PhotoSize>|null
     */
    public function getCover(): ?Collection
    {
        return $this->items['cover'] ?? null;
    }

    /**
     * (Optional). Timestamp in seconds from which the video will play in the message.
     */
    public function getStartTimestamp(): ?int
    {
        return $this->items['start_timestamp'] ?? null;
    }

    /**
     * (Optional). Mime type of a file as defined by sender.
     */
    public function getMimeType(): ?string
    {
        return $this->items['mime_type'] ?? null;
    }

    /**
     * (Optional). File size.
     */
    public function getFileSize(): ?int
    {
        return $this->items['file_size'] ?? null;
    }

    /**
     * (Optional). Available qualities of the video.
     *
     * @return Collection<int, VideoQuality>|null
     */
    public function getQualities(): ?Collection
    {
        return $this->items['qualities'] ?? null;
    }
}
