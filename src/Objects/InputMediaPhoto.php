<?php

namespace Telegram\Bot\Objects;

/**
 * Class InputMediaPhoto.
 *
 * Represents a photo to be sent.
 *
 * @link https://core.telegram.org/bots/api#inputmediaphoto
 */
class InputMediaPhoto extends InputMedia
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
     * Type of the result, must be photo.
     */
    public function getType(): string
    {
        return 'photo';
    }

    /**
     * File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a file from the Internet, or pass “attach://<file_attach_name>” to upload a new one using multipart/form-data under <file_attach_name> name.
     */
    public function getMedia(): string
    {
        return $this->items['media'];
    }

    /**
     * (Optional). Caption of the photo to be sent, 0-1024 characters.
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
     * (Optional). Pass True if the photo needs to be covered with a spoiler animation.
     */
    public function getHasSpoiler(): ?bool
    {
        return $this->items['has_spoiler'] ?? null;
    }
}
