<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the getStickerSet method.
 *
 * Use this method to get a sticker set.
 *
 * @link https://core.telegram.org/bots/api#getstickerset
 */
class GetStickerSetRequest extends TelegramApiRequest
{
    /**
     * @param  string  $name  Name of the sticker set
     */
    public function __construct(
        protected string $name,
    ) {}

    public function getMethod(): string
    {
        return 'getStickerSet';
    }

    public function validate(): void
    {
        if (empty($this->name)) {
            throw new TelegramValidationException('name cannot be empty');
        }
    }

    public function buildParams(): array
    {
        return [
            'name' => $this->name,
        ];
    }
}
