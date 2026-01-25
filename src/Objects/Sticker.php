<?php

namespace Telegram\Bot\Objects;

/**
 * Class Sticker.
 *
 * This object represents a sticker.
 */
class Sticker extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'thumbnail' => PhotoSize::class,
            'premium_animation' => File::class,
            'mask_position' => MaskPosition::class,
        ];
    }

    /**
     * Identifier for this file, which can be used to download or reuse the file.
     */
    public function getFileId(): string
    {
        return $this->items['file_id'];
    }

    /**
     * Unique identifier for this file, which is supposed to be the same over time and for different bots.
     */
    public function getFileUniqueId(): string
    {
        return $this->items['file_unique_id'];
    }

    /**
     * Type of the sticker, currently one of "regular", "mask", "custom_emoji".
     */
    public function getType(): string
    {
        return $this->items['type'];
    }

    /**
     * Sticker width.
     */
    public function getWidth(): int
    {
        return $this->items['width'];
    }

    /**
     * Sticker height.
     */
    public function getHeight(): int
    {
        return $this->items['height'];
    }

    /**
     * True, if the sticker is animated.
     */
    public function getIsAnimated(): bool
    {
        return $this->items['is_animated'];
    }

    /**
     * True, if the sticker is a video sticker.
     */
    public function getIsVideo(): bool
    {
        return $this->items['is_video'];
    }

    /**
     * (Optional). Sticker thumbnail in the .WEBP or .JPG format.
     */
    public function getThumbnail(): ?PhotoSize
    {
        return $this->items['thumbnail'] ?? null;
    }

    /**
     * (Optional). Emoji associated with the sticker.
     */
    public function getEmoji(): ?string
    {
        return $this->items['emoji'] ?? null;
    }

    /**
     * (Optional). Name of the sticker set to which the sticker belongs.
     */
    public function getSetName(): ?string
    {
        return $this->items['set_name'] ?? null;
    }

    /**
     * (Optional). Premium animation for the sticker, if the sticker is premium.
     */
    public function getPremiumAnimation(): ?File
    {
        return $this->items['premium_animation'] ?? null;
    }

    /**
     * (Optional). For mask stickers, the position where the mask should be placed.
     */
    public function getMaskPosition(): ?MaskPosition
    {
        return $this->items['mask_position'] ?? null;
    }

    /**
     * (Optional). For custom emoji stickers, unique identifier of the custom emoji.
     */
    public function getCustomEmojiId(): ?string
    {
        return $this->items['custom_emoji_id'] ?? null;
    }

    /**
     * (Optional). True, if the sticker must be reprinted as a regular sticker.
     */
    public function getNeedsRepainting(): ?bool
    {
        return $this->items['needs_repainting'] ?? null;
    }

    /**
     * (Optional). File size in bytes.
     */
    public function getFileSize(): ?int
    {
        return $this->items['file_size'] ?? null;
    }
}
