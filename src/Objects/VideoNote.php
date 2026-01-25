<?php

namespace Telegram\Bot\Objects;

/**
 * Class VideoNote. *
 */
class VideoNote extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'thumb' => PhotoSize::class,
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
     * Video width and height as defined by sender.
     */
    public function getLength(): int
    {
        return $this->items['length'];
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
     */
    public function getThumb(): ?PhotoSize
    {
        return $this->items['thumb'] ?? null;
    }

    /**
     * (Optional). File size.
     */
    public function getFileSize(): ?int
    {
        return $this->items['file_size'] ?? null;
    }
}
