<?php

namespace Telegram\Bot\Objects\InlineQuery;

use Illuminate\Support\Collection;
use Telegram\Bot\Objects\MessageEntity;

/**
 * Class InlineQueryResultDocument.
 *
 * Represents a link to a file.
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultdocument
 */
class InlineQueryResultDocument extends InlineQueryResult
{
    public function __construct($params = [])
    {
        parent::__construct($params);
        $this->put('type', 'document');
    }

    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return array_merge(parent::relations(), [
            'caption_entities' => MessageEntity::class,
        ]);
    }

    /**
     * Title of the result.
     */
    public function getTitle(): string
    {
        return $this->items['title'];
    }

    /**
     * A valid URL for the file.
     */
    public function getDocumentUrl(): string
    {
        return $this->items['document_url'];
    }

    /**
     * MIME type of the file.
     */
    public function getMimeType(): string
    {
        return $this->items['mime_type'];
    }

    /**
     * (Optional). Caption for the document.
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
     *
     * @return array<int, MessageEntity>|null
     */
    public function getCaptionEntities(): ?array
    {
        $entities = $this->items['caption_entities'] ?? null;

        if ($entities instanceof Collection) {
            return $entities->all();
        }

        return $entities;
    }

    /**
     * (Optional). Short description of the result.
     */
    public function getDescription(): ?string
    {
        return $this->items['description'] ?? null;
    }

    /**
     * (Optional). URL of the thumbnail for the result.
     */
    public function getThumbUrl(): ?string
    {
        return $this->items['thumb_url'] ?? null;
    }

    /**
     * (Optional). Thumbnail width.
     */
    public function getThumbWidth(): ?int
    {
        return $this->items['thumb_width'] ?? null;
    }

    /**
     * (Optional). Thumbnail height.
     */
    public function getThumbHeight(): ?int
    {
        return $this->items['thumb_height'] ?? null;
    }
}
