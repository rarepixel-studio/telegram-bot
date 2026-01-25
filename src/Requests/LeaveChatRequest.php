<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the leaveChat method.
 *
 * Use this method for your bot to leave a group, supergroup or channel.
 *
 * @link https://core.telegram.org/bots/api#leavechat
 */
class LeaveChatRequest extends TelegramApiRequest
{
    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target supergroup or channel
     */
    public function __construct(
        protected int|string $chat_id,
    ) {}

    public function getMethod(): string
    {
        return 'leaveChat';
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
