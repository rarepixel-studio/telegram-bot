<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\InputSticker;

/**
 * Request object for the replaceStickerInSet method.
 *
 * Use this method to replace an existing sticker in a sticker set with a new one.
 *
 * @link https://core.telegram.org/bots/api#replacestickerinset
 */
class ReplaceStickerInSetRequest extends TelegramApiRequest
{
    /**
     * @param  int  $user_id  User identifier of the sticker set owner
     * @param  string  $name  Sticker set name
     * @param  string  $old_sticker  File identifier of the replaced sticker
     * @param  InputSticker  $sticker  InputSticker object with the new sticker
     */
    public function __construct(
        protected int $user_id,
        protected string $name,
        protected string $old_sticker,
        protected InputSticker $sticker,
    ) {}

    public function getMethod(): string
    {
        return 'replaceStickerInSet';
    }

    public function validate(): void
    {
        if ($this->user_id <= 0) {
            throw new TelegramValidationException('user_id must be greater than 0');
        }
    }

    public function buildParams(): array
    {
        return [
            'user_id' => $this->user_id,
            'name' => $this->name,
            'old_sticker' => $this->old_sticker,
            'sticker' => $this->sticker,
        ];
    }
}
