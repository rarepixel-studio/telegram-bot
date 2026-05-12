<?php

namespace Telegram\Bot\Objects;

/**
 * Class InputMediaLivePhoto.
 *
 * Represents a live photo to be sent.
 */
class InputMediaLivePhoto extends InputMedia
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
     * Type of the result, must be live_photo.
     */
    public function getType(): string
    {
        return 'live_photo';
    }

    /**
     * Video of the live photo to send.
     */
    public function getMedia(): string
    {
        return $this->items['media'];
    }

    /**
     * The static photo to send.
     */
    public function getPhoto(): string
    {
        return $this->items['photo'];
    }

    /**
     * (Optional). Caption of the live photo to be sent, 0-1024 characters.
     */
    public function getCaption(): ?string
    {
        return $this->items['caption'] ?? null;
    }

    /**
     * (Optional). Mode for parsing entities in the live photo caption.
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
     * (Optional). Pass True if the live photo needs to be covered with a spoiler animation.
     */
    public function getHasSpoiler(): ?bool
    {
        return $this->items['has_spoiler'] ?? null;
    }
}
