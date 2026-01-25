<?php

namespace Telegram\Bot\Objects\InlineQuery;

use Illuminate\Support\Collection;
use Telegram\Bot\Objects\MessageEntity;

/**
 * Class InlineQueryResultVideo.
 *
 * Represents a link to a page containing an embedded video player.
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultvideo
 */
class InlineQueryResultVideo extends InlineQueryResult
{
    public function __construct($params = [])
    {
        parent::__construct($params);
        $this->put('type', 'video');
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
     * A valid URL for the embedded video player or video file.
     */
    public function getVideoUrl(): string
    {
        return $this->items['video_url'];
    }

    /**
     * MIME type of the content of the video URL.
     */
    public function getMimeType(): string
    {
        return $this->items['mime_type'];
    }

    /**
     * URL of the thumbnail for the result.
     */
    public function getThumbUrl(): string
    {
        return $this->items['thumb_url'];
    }

    /**
     * Title of the result.
     */
    public function getTitle(): string
    {
        return $this->items['title'];
    }

    /**
     * (Optional). Caption for the video.
     */
    public function getCaption(): ?string
    {
        return $this->items['caption'] ?? null;
    }

    /**
     * (Optional). Mode for parsing entities in the video caption.
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
     * (Optional). Video width.
     */
    public function getVideoWidth(): ?int
    {
        return $this->items['video_width'] ?? null;
    }

    /**
     * (Optional). Video height.
     */
    public function getVideoHeight(): ?int
    {
        return $this->items['video_height'] ?? null;
    }

    /**
     * (Optional). Video duration in seconds.
     */
    public function getVideoDuration(): ?int
    {
        return $this->items['video_duration'] ?? null;
    }

    /**
     * (Optional). Short description of the result.
     */
    public function getDescription(): ?string
    {
        return $this->items['description'] ?? null;
    }
}
