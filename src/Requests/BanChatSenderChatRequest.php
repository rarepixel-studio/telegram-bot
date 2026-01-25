<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the banChatSenderChat method.
 *
 * Use this method to ban a channel chat in a supergroup or a channel.
 * Until the chat is unbanned, the owner of the banned chat won't be able to send messages on behalf of any of their channels.
 *
 * @link https://core.telegram.org/bots/api#banchatsenderchat
 */
class BanChatSenderChatRequest extends TelegramApiRequest
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
        return 'banChatSenderChat';
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
