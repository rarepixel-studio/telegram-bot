<?php

namespace Telegram\Bot\Objects\InlineQuery;

use Illuminate\Support\Collection;
use Telegram\Bot\Objects\MessageEntity;

/**
 * Class InlineQueryResultCachedMpeg4Gif.
 *
 * Represents a link to a MPEG4 GIF stored on Telegram servers.
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultcachedmpeg4gif
 */
class InlineQueryResultCachedMpeg4Gif extends InlineQueryResult
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
     * A valid file identifier for the MPEG4 GIF.
     */
    public function getMpeg4FileId(): string
    {
        return $this->items['mpeg4_file_id'];
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
