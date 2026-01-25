<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the deleteChatPhoto method.
 *
 * Use this method to delete a chat photo.
 *
 * @link https://core.telegram.org/bots/api#deletechatphoto
 */
class DeleteChatPhotoRequest extends TelegramApiRequest
{
    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     */
    public function __construct(
        protected int|string $chat_id,
    ) {}

    public function getMethod(): string
    {
        return 'deleteChatPhoto';
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
