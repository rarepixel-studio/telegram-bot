<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the setChatStickerSet method.
 *
 * Use this method to set a new group sticker set for a supergroup.
 *
 * @link https://core.telegram.org/bots/api#setchatstickerset
 */
class SetChatStickerSetRequest extends TelegramApiRequest
{
    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target supergroup
     * @param  string  $sticker_set_name  Name of the sticker set to be set as the group sticker set
     */
    public function __construct(
        protected int|string $chat_id,
        protected string $sticker_set_name,
    ) {}

    public function getMethod(): string
    {
        return 'setChatStickerSet';
    }

    public function validate(): void
    {
        if (empty($this->sticker_set_name)) {
            throw new TelegramValidationException('sticker_set_name cannot be empty');
        }
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'sticker_set_name' => $this->sticker_set_name,
        ];
    }
}
