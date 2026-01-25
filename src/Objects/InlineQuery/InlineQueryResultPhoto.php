<?php

namespace Telegram\Bot\Objects\InlineQuery;

use Illuminate\Support\Collection;
use Telegram\Bot\Objects\MessageEntity;

/**
 * Class InlineQueryResultPhoto.
 *
 * Represents a link to a photo.
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultphoto
 */
class InlineQueryResultPhoto extends InlineQueryResult
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
     * A valid URL for the photo.
     */
    public function getPhotoUrl(): string
    {
        return $this->items['photo_url'];
    }

    /**
     * URL of the thumbnail for the result.
     */
    public function getThumbUrl(): string
    {
        return $this->items['thumb_url'];
    }

    /**
     * (Optional). Photo width.
     */
    public function getPhotoWidth(): ?int
    {
        return $this->items['photo_width'] ?? null;
    }

    /**
     * (Optional). Photo height.
     */
    public function getPhotoHeight(): ?int
    {
        return $this->items['photo_height'] ?? null;
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
