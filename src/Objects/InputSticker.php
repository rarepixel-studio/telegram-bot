<?php

namespace Telegram\Bot\Objects;

use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\FileUpload\InputFileInterface;

/**
 * Class InputSticker.
 *
 * This object describes a sticker to be added to a sticker set.
 */
class InputSticker extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'mask_position' => MaskPosition::class,
        ];
    }

    /**
     * The added sticker. Pass a file_id as a String to send a file that exists on the Telegram servers, pass an HTTP URL as a String for Telegram to get a file from the Internet, or upload a new one using multipart/form-data.
     */
    public function getSticker(): InputFile
    {
        return $this->items['sticker'];
    }

    /**
     * List of 1-20 emoji associated with the sticker.
     */
    public function getEmojiList(): array
    {
        return $this->items['emoji_list'];
    }

    /**
     * (Optional). Position where the mask should be placed on faces. For "mask" stickers only.
     */
    public function getMaskPosition(): ?MaskPosition
    {
        return $this->items['mask_position'] ?? null;
    }

    /**
     * (Optional). List of 0-20 search keywords for the sticker with total length of up to 64 characters. For "regular" and "custom_emoji" stickers only.
     */
    public function getKeywords(): ?array
    {
        return $this->items['keywords'] ?? null;
    }
    /**
     * @throws TelegramSDKException
     */
    public function extractAttachment(string $name, string $field = 'sticker'): ?array
    {
        if (! $this->has($field)) {
            return null;
        }
        $media = $this[$field];

        $validUrl = filter_var($media, FILTER_VALIDATE_URL);
        if (is_string($media) && (is_file($media) || $validUrl)) {
            $media = (new InputFile($media))->open();
        }

        if ($media instanceof InputFileInterface) {
            $media = $media->open();
        }

        if (is_resource($media) || $media instanceof \Psr\Http\Message\StreamInterface) {
            $this[$field] = 'attach://'.$name;

            return [
                'name' => $name,
                'contents' => $media,
            ];
        }

        return null;
    }
}
