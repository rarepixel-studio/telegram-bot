<?php

namespace Telegram\Bot\Objects;

/**
 * Class PhotoSize. *
 */
class PhotoSize extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Unique identifier for this file.
     */
    public function getFileId(): string
    {
        return $this->items['file_id'];
    }

    /**
     * Photo width.
     */
    public function getWidth(): int
    {
        return $this->items['width'];
    }

    /**
     * Photo height.
     */
    public function getHeight(): int
    {
        return $this->items['height'];
    }

    /**
     * (Optional). File size.
     */
    public function getFileSize(): ?int
    {
        return $this->items['file_size'] ?? null;
    }
}
