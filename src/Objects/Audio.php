<?php

namespace Telegram\Bot\Objects;

/**
 * Class Audio. *
 */
class Audio extends BaseObject
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
     * (Optional). Performer of the audio as defined by sender or by audio tags.
     */
    public function getPerformer(): ?string
    {
        return $this->items['performer'] ?? null;
    }

    /**
     * (Optional). Title of the audio as defined by sender or by audio tags.
     */
    public function getTitle(): ?string
    {
        return $this->items['title'] ?? null;
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

    /**
     * (Optional). Thumbnail of the album cover to which the music file belongs
     */
    public function getThumb(): ?PhotoSize
    {
        return $this->items['thumb'] ?? null;
    }
}
