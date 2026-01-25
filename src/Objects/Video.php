<?php

namespace Telegram\Bot\Objects;

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
     */
    public function getThumb(): ?PhotoSize
    {
        return $this->items['thumb'] ?? null;
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
}
