<?php

namespace Telegram\Bot\Objects;

/**
 * Class InputMediaDocument.
 *
 * Represents a general file to be sent.
 *
 * @link https://core.telegram.org/bots/api#inputmediadocument
 */
class InputMediaDocument extends InputMedia
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'caption_entities' => MessageEntity::class,
        ];
    }

    /**
     * Type of the result, must be document.
     */
    public function getType(): string
    {
        return 'document';
    }

    /**
     * File to send.
     */
    public function getMedia(): string
    {
        return $this->items['media'];
    }

    /**
     * (Optional). Thumbnail of the file sent.
     */
    public function getThumbnail(): mixed
    {
        return $this->items['thumbnail'] ?? null;
    }

    /**
     * (Optional). Caption of the document to be sent, 0-1024 characters.
     */
    public function getCaption(): ?string
    {
        return $this->items['caption'] ?? null;
    }

    /**
     * (Optional). Mode for parsing entities in the document caption.
     */
    public function getParseMode(): ?string
    {
        return $this->items['parse_mode'] ?? null;
    }

    /**
     * (Optional). List of special entities that appear in the caption.
     */
    public function getCaptionEntities(): ?array
    {
        return $this->items['caption_entities'] ?? null;
    }

    /**
     * (Optional). Disables automatic server-side content type detection for files uploaded using multipart/form-data.
     */
    public function getDisableContentTypeDetection(): ?bool
    {
        return $this->items['disable_content_type_detection'] ?? null;
    }
}
