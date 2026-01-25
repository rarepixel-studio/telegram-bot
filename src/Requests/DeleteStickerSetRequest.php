<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the deleteStickerSet method.
 *
 * Use this method to delete a sticker set.
 *
 * @link https://core.telegram.org/bots/api#deletestickerset
 */
class DeleteStickerSetRequest extends TelegramApiRequest
{
    /**
     * @param  string  $name  Sticker set name
     */
    public function __construct(
        protected string $name,
    ) {}

    public function getMethod(): string
    {
        return 'deleteStickerSet';
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
