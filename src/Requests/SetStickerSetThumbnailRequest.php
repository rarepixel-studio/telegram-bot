<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\FileUpload\InputFile;

/**
 * Request object for the setStickerSetThumbnail method.
 *
 * Use this method to set the thumbnail of a regular or mask sticker set.
 *
 * @link https://core.telegram.org/bots/api#setstickersetthumbnail
 */
class SetStickerSetThumbnailRequest extends TelegramApiRequest
{
    /**
     * @param  string  $name  Sticker set name
     * @param  int  $user_id  User identifier of the sticker set owner
     * @param  string  $format  Format of the thumbnail, must be one of "static", "animated", "video"
     */
    public function __construct(
        protected string $name,
        protected int $user_id,
        protected string $format,
    ) {}

    protected array $params = [];

    public function thumbnail(InputFile|string $thumbnail): self
    {
        $this->params['thumbnail'] = $thumbnail;

        return $this;
    }

    public function getMethod(): string
    {
        return 'setStickerSetThumbnail';
    }

    public function validate(): void
    {
        if ($this->user_id <= 0) {
            throw new TelegramValidationException('user_id must be greater than 0');
        }
        if (! in_array($this->format, ['static', 'animated', 'video'])) {
            throw new TelegramValidationException('Invalid thumbnail format');
        }
    }

    public function buildParams(): array
    {
        return [
            'name' => $this->name,
            'user_id' => $this->user_id,
            'format' => $this->format,
        ] + $this->params;
    }
}
