<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the getUserChatBoosts method.
 *
 * Use this method to get the list of boosts added to a chat by a user.
 *
 * @link https://core.telegram.org/bots/api#getuserchatboosts
 */
class GetUserChatBoostsRequest extends TelegramApiRequest
{
    /**
     * @param  int|string  $chat_id  Unique identifier for the chat or username of the channel
     * @param  int  $user_id  Unique identifier of the target user
     */
    public function __construct(
        protected int|string $chat_id,
        protected int $user_id,
    ) {}

    public function getMethod(): string
    {
        return 'getUserChatBoosts';
    }

    public function validate(): void
    {
        if ($this->user_id <= 0) {
            throw new TelegramValidationException('user_id must be greater than 0');
        }
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'user_id' => $this->user_id,
        ];
    }
}
