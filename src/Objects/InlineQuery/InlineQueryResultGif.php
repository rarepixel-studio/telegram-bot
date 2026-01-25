<?php

namespace Telegram\Bot\Objects\InlineQuery;

use Illuminate\Support\Collection;
use Telegram\Bot\Objects\MessageEntity;

/**
 * Class InlineQueryResultGif.
 *
 * Represents a link to an animated GIF file.
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultgif
 */
class InlineQueryResultGif extends InlineQueryResult
{
    public function __construct($params = [])
    {
        parent::__construct($params);
        $this->put('type', 'gif');
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
     * A valid URL for the GIF file.
     */
    public function getGifUrl(): string
    {
        return $this->items['gif_url'];
    }

    /**
     * (Optional). GIF width.
     */
    public function getGifWidth(): ?int
    {
        return $this->items['gif_width'] ?? null;
    }

    /**
     * (Optional). GIF height.
     */
    public function getGifHeight(): ?int
    {
        return $this->items['gif_height'] ?? null;
    }

    /**
     * (Optional). GIF duration in seconds.
     */
    public function getGifDuration(): ?int
    {
        return $this->items['gif_duration'] ?? null;
    }

    /**
     * URL of the thumbnail for the result.
     */
    public function getThumbUrl(): string
    {
        return $this->items['thumb_url'];
    }

    /**
     * (Optional). MIME type of the thumbnail.
     */
    public function getThumbMimeType(): ?string
    {
        return $this->items['thumb_mime_type'] ?? null;
    }

    /**
     * (Optional). Title of the result.
     */
    public function getTitle(): ?string
    {
        return $this->items['title'] ?? null;
    }

    /**
     * (Optional). Caption for the GIF.
     */
    public function getCaption(): ?string
    {
        return $this->items['caption'] ?? null;
    }

    /**
     * (Optional). Mode for parsing entities in the GIF caption.
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
}
