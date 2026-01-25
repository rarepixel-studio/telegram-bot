<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the getChat method.
 *
 * Use this method to get up to date information about the chat.
 *
 * @link https://core.telegram.org/bots/api#getchat
 */
class GetChatRequest extends TelegramApiRequest
{
    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target supergroup or channel
     */
    public function __construct(
        protected int|string $chat_id,
    ) {}

    public function getMethod(): string
    {
        return 'getChat';
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
