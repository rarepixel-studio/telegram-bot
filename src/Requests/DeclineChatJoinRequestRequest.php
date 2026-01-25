<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the declineChatJoinRequest method.
 *
 * Use this method to decline a chat join request.
 *
 * @link https://core.telegram.org/bots/api#declinechatjoinrequest
 */
class DeclineChatJoinRequestRequest extends TelegramApiRequest
{
    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     * @param  int  $user_id  Unique identifier of the target user
     */
    public function __construct(
        protected int|string $chat_id,
        protected int $user_id,
    ) {}

    public function getMethod(): string
    {
        return 'declineChatJoinRequest';
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
