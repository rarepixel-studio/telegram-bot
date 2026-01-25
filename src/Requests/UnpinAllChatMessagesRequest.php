<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the unpinAllChatMessages method.
 *
 * Use this method to clear the list of pinned messages in a chat.
 *
 * @link https://core.telegram.org/bots/api#unpinallchatmessages
 */
class UnpinAllChatMessagesRequest extends TelegramApiRequest
{
    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     */
    public function __construct(
        protected int|string $chat_id,
    ) {}

    public function getMethod(): string
    {
        return 'unpinAllChatMessages';
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
