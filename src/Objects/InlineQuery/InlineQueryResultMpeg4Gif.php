<?php

namespace Telegram\Bot\Objects\InlineQuery;

use Illuminate\Support\Collection;
use Telegram\Bot\Objects\MessageEntity;

/**
 * Class InlineQueryResultMpeg4Gif.
 *
 * Represents a link to a MPEG4 GIF.
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultmpeg4gif
 */
class InlineQueryResultMpeg4Gif extends InlineQueryResult
{
    public function __construct($params = [])
    {
        parent::__construct($params);
        $this->put('type', 'mpeg4_gif');
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
     * A valid URL for the MPEG4 file.
     */
    public function getMpeg4Url(): string
    {
        return $this->items['mpeg4_url'];
    }

    /**
     * (Optional). MPEG4 width.
     */
    public function getMpeg4Width(): ?int
    {
        return $this->items['mpeg4_width'] ?? null;
    }

    /**
     * (Optional). MPEG4 height.
     */
    public function getMpeg4Height(): ?int
    {
        return $this->items['mpeg4_height'] ?? null;
    }

    /**
     * (Optional). MPEG4 duration in seconds.
     */
    public function getMpeg4Duration(): ?int
    {
        return $this->items['mpeg4_duration'] ?? null;
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
     * (Optional). Caption for the MPEG4 GIF.
     */
    public function getCaption(): ?string
    {
        return $this->items['caption'] ?? null;
    }

    /**
     * (Optional). Mode for parsing entities in the MPEG4 GIF caption.
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
