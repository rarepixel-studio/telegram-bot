<?php

namespace Telegram\Bot\Objects;

/**
 * Class Voice. *
 */
class Voice extends BaseObject
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
     * Duration of the audio in seconds as defined by sender.
     */
    public function getDuration(): int
    {
        return $this->items['duration'];
    }

    /**
     * (Optional). MIME type of the file as defined by sender.
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
