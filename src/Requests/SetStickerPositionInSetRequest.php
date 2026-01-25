<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the setStickerPositionInSet method.
 *
 * Use this method to move a sticker in a set created by the bot to a specific position.
 *
 * @link https://core.telegram.org/bots/api#setstickerpositioninset
 */
class SetStickerPositionInSetRequest extends TelegramApiRequest
{
    /**
     * @param  string  $sticker  File identifier of the sticker
     * @param  int  $position  New sticker position in the set, zero-based
     */
    public function __construct(
        protected string $sticker,
        protected int $position,
    ) {}

    public function getMethod(): string
    {
        return 'setStickerPositionInSet';
    }

    public function validate(): void
    {
        if (empty($this->sticker)) {
            throw new TelegramValidationException('sticker cannot be empty');
        }
        if ($this->position < 0) {
            throw new TelegramValidationException('position must be non-negative');
        }
    }

    public function buildParams(): array
    {
        return [
            'sticker' => $this->sticker,
            'position' => $this->position,
        ];
    }
}
