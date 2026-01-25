<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the unbanChatSenderChat method.
 *
 * Use this method to unban a previously banned channel chat in a supergroup or channel.
 * The bot must be an administrator for this to work and must have the appropriate administrator rights.
 *
 * @link https://core.telegram.org/bots/api#unbanchatsenderchat
 */
class UnbanChatSenderChatRequest extends TelegramApiRequest
{
    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     * @param  int  $sender_chat_id  Unique identifier of the target sender chat
     */
    public function __construct(
        protected int|string $chat_id,
        protected int $sender_chat_id,
    ) {}

    public function getMethod(): string
    {
        return 'unbanChatSenderChat';
    }

    public function validate(): void
    {
        // No specific validation needed - sender_chat_id can be any valid chat ID
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'sender_chat_id' => $this->sender_chat_id,
        ];
    }
}
