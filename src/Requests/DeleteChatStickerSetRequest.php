<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the deleteChatStickerSet method.
 *
 * Use this method to delete a group sticker set from a supergroup.
 *
 * @link https://core.telegram.org/bots/api#deletechatstickerset
 */
class DeleteChatStickerSetRequest extends TelegramApiRequest
{
    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target supergroup
     */
    public function __construct(
        protected int|string $chat_id,
    ) {}

    public function getMethod(): string
    {
        return 'deleteChatStickerSet';
    }

    public function validate(): void
    {
        // No specific validation needed
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
        ];
    }
}
