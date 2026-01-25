<?php

namespace Telegram\Bot\Objects;

/**
 * Class InputMediaAnimation.
 *
 * Represents an animation file (GIF or H.264/MPEG-4 AVC video without sound) to be sent.
 *
 * @link https://core.telegram.org/bots/api#inputmediaanimation
 */
class InputMediaAnimation extends InputMedia
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
     * Type of the result, must be animation.
     */
    public function getType(): string
    {
        return 'animation';
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
     * (Optional). Caption of the animation to be sent, 0-1024 characters.
     */
    public function getCaption(): ?string
    {
        return $this->items['caption'] ?? null;
    }

    /**
     * (Optional). Mode for parsing entities in the animation caption.
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
     * (Optional). Animation width.
     */
    public function getWidth(): ?int
    {
        return $this->items['width'] ?? null;
    }

    /**
     * (Optional). Animation height.
     */
    public function getHeight(): ?int
    {
        return $this->items['height'] ?? null;
    }

    /**
     * (Optional). Animation duration.
     */
    public function getDuration(): ?int
    {
        return $this->items['duration'] ?? null;
    }

    /**
     * (Optional). Pass True if the animation needs to be covered with a spoiler animation.
     */
    public function getHasSpoiler(): ?bool
    {
        return $this->items['has_spoiler'] ?? null;
    }
}
