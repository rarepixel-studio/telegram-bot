<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the getChatAdministrators method.
 *
 * Use this method to get a list of administrators in a chat.
 *
 * @link https://core.telegram.org/bots/api#getchatadministrators
 */
class GetChatAdministratorsRequest extends TelegramApiRequest
{
    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target supergroup or channel
     */
    public function __construct(
        protected int|string $chat_id,
    ) {}

    public function getMethod(): string
    {
        return 'getChatAdministrators';
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
