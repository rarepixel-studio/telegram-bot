<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\FileUpload\InputFile;

/**
 * Request object for the uploadStickerFile method.
 *
 * Use this method to upload a file with a sticker for later use.
 *
 * @link https://core.telegram.org/bots/api#uploadstickerfile
 */
class UploadStickerFileRequest extends TelegramApiRequest
{
    /**
     * @param  int  $user_id  User identifier of sticker file owner
     * @param  InputFile  $sticker  A file with the sticker
     * @param  string  $sticker_format  Format of the sticker, must be one of "static", "animated", "video"
     */
    public function __construct(
        protected int $user_id,
        protected InputFile $sticker,
        protected string $sticker_format,
    ) {}

    public function getMethod(): string
    {
        return 'uploadStickerFile';
    }

    public function validate(): void
    {
        if ($this->user_id <= 0) {
            throw new TelegramValidationException('user_id must be greater than 0');
        }
        if (! in_array($this->sticker_format, ['static', 'animated', 'video'])) {
            throw new TelegramValidationException('Invalid sticker format');
        }
    }

    public function buildParams(): array
    {
        return [
            'user_id' => $this->user_id,
            'sticker' => $this->sticker,
            'sticker_format' => $this->sticker_format,
        ];
    }
}
