<?php

namespace Telegram\Bot\Objects;

/**
 * Class VideoQuality.
 *
 * Represents a video file of a specific quality.
 *
 * @link https://core.telegram.org/bots/api#videoquality
 */
class VideoQuality extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Identifier for this file, which can be used to download or reuse the file.
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
     * Video width.
     */
    public function getWidth(): int
    {
        return $this->items['width'];
    }

    /**
     * Video height.
     */
    public function getHeight(): int
    {
        return $this->items['height'];
    }

    /**
     * Duration of the video in seconds.
     */
    public function getDuration(): int
    {
        return $this->items['duration'];
    }

    /**
     * (Optional). File size in bytes.
     */
    public function getFileSize(): ?int
    {
        return $this->items['file_size'] ?? null;
    }
}
