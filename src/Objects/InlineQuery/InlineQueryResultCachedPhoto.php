<?php

namespace Telegram\Bot\Objects\InlineQuery;

use Illuminate\Support\Collection;
use Telegram\Bot\Objects\MessageEntity;

/**
 * Class InlineQueryResultCachedPhoto.
 *
 * Represents a link to a photo stored on Telegram servers.
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultcachedphoto
 */
class InlineQueryResultCachedPhoto extends InlineQueryResult
{
    public function __construct($params = [])
    {
        parent::__construct($params);
        $this->put('type', 'photo');
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
     * A valid file identifier for the photo.
     */
    public function getPhotoFileId(): string
    {
        return $this->items['photo_file_id'];
    }

    /**
     * (Optional). Title of the result.
     */
    public function getTitle(): ?string
    {
        return $this->items['title'] ?? null;
    }

    /**
     * (Optional). Short description of the result.
     */
    public function getDescription(): ?string
    {
        return $this->items['description'] ?? null;
    }

    /**
     * (Optional). Caption for the photo.
     */
    public function getCaption(): ?string
    {
        return $this->items['caption'] ?? null;
    }

    /**
     * (Optional). Mode for parsing entities in the photo caption.
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
