<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the deleteStickerFromSet method.
 *
 * Use this method to delete a sticker from a set created by the bot.
 *
 * @link https://core.telegram.org/bots/api#deletestickerfromset
 */
class DeleteStickerFromSetRequest extends TelegramApiRequest
{
    /**
     * @param  string  $sticker  File identifier of the sticker
     */
    public function __construct(
        protected string $sticker,
    ) {}

    public function getMethod(): string
    {
        return 'deleteStickerFromSet';
    }

    public function validate(): void
    {
        if (empty($this->sticker)) {
            throw new TelegramValidationException('sticker cannot be empty');
        }
    }

    public function buildParams(): array
    {
        return [
            'sticker' => $this->sticker,
        ];
    }
}
