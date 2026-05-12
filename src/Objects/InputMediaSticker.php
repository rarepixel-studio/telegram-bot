<?php

namespace Telegram\Bot\Objects;

/**
 * Class InputMediaSticker.
 *
 * Represents a sticker to be sent.
 */
class InputMediaSticker extends InputMedia
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Type of the result, must be sticker.
     */
    public function getType(): string
    {
        return 'sticker';
    }

    /**
     * File to send. Pass a file_id to send a file that exists on the Telegram servers (recommended), pass an HTTP URL for Telegram to get a .WEBP sticker from the Internet, or pass "attach://<file_attach_name>" to upload a new .WEBP, .TGS, or .WEBM sticker using multipart/form-data under <file_attach_name> name.
     */
    public function getMedia(): string
    {
        return $this->items['media'];
    }

    /**
     * (Optional). Emoji associated with the sticker; only for just uploaded stickers.
     */
    public function getEmoji(): ?string
    {
        return $this->items['emoji'] ?? null;
    }
}
