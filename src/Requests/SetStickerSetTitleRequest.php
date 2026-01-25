<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the setStickerSetTitle method.
 *
 * Use this method to set the title of a created sticker set.
 *
 * @link https://core.telegram.org/bots/api#setstickersettitle
 */
class SetStickerSetTitleRequest extends TelegramApiRequest
{
    /**
     * @param  string  $name  Sticker set name
     * @param  string  $title  Sticker set title
     */
    public function __construct(
        protected string $name,
        protected string $title,
    ) {}

    public function getMethod(): string
    {
        return 'setStickerSetTitle';
    }

    public function validate(): void
    {
        if (empty($this->name)) {
            throw new TelegramValidationException('name cannot be empty');
        }
        if (empty($this->title)) {
            throw new TelegramValidationException('title cannot be empty');
        }
    }

    public function buildParams(): array
    {
        return [
            'name' => $this->name,
            'title' => $this->title,
        ];
    }
}
