<?php

namespace Telegram\Bot\Objects;

/**
 * Class InputMediaVideo.
 *
 * Represents a video to be sent.
 *
 * @link https://core.telegram.org/bots/api#inputmediavideo
 */
class InputMediaVideo extends InputMedia
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
     * Type of the result, must be video.
     */
    public function getType(): string
    {
        return 'video';
    }

    /**
     * File to send.
     */
    public function getMedia(): string
    {
        return $this->items['media'];
    }

    /**
     * (Optional). Thumbnail of the file sent; can be ignored if thumbnail generation for the file is supported server-side.
     */
    public function getThumbnail(): mixed
    {
        return $this->items['thumbnail'] ?? null;
    }

    /**
     * (Optional). Caption of the video to be sent, 0-1024 characters.
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
     */
    public function getCaptionEntities(): ?array
    {
        return $this->items['caption_entities'] ?? null;
    }

    /**
     * (Optional). Pass True if the caption must be shown above the message media.
     */
    public function getShowCaptionAboveMedia(): ?bool
    {
        return $this->items['show_caption_above_media'] ?? null;
    }

    /**
     * (Optional). Video width.
     */
    public function getWidth(): ?int
    {
        return $this->items['width'] ?? null;
    }

    /**
     * (Optional). Video height.
     */
    public function getHeight(): ?int
    {
        return $this->items['height'] ?? null;
    }

    /**
     * (Optional). Video duration.
     */
    public function getDuration(): ?int
    {
        return $this->items['duration'] ?? null;
    }

    /**
     * (Optional). Pass True if the uploaded video is suitable for streaming.
     */
    public function getSupportsStreaming(): ?bool
    {
        return $this->items['supports_streaming'] ?? null;
    }

    /**
     * (Optional). Pass True if the video needs to be covered with a spoiler animation.
     */
    public function getHasSpoiler(): ?bool
    {
        return $this->items['has_spoiler'] ?? null;
    }
}
