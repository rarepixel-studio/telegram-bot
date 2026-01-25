<?php

namespace Telegram\Bot\Objects;

/**
 * Class Document. *
 */
class Document extends BaseObject
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
     * Unique file identifier.
     */
    public function getFileId(): string
    {
        return $this->items['file_id'];
    }

    /**
     * (Optional). Document thumbnail as defined by sender.
     */
    public function getThumb(): ?PhotoSize
    {
        return $this->items['thumb'] ?? null;
    }

    /**
     * (Optional). Original filename as defined by sender.
     */
    public function getFileName(): ?string
    {
        return $this->items['file_name'] ?? null;
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
