<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the getUserPersonalChatMessages method.
 *
 * Use this method to get the last messages from the personal chat of a given user.
 *
 * @link https://core.telegram.org/bots/api#getuserpersonalchatmessages
 */
class GetUserPersonalChatMessagesRequest extends TelegramApiRequest
{
    /**
     * @param  int  $user_id  Unique identifier for the target user
     * @param  int  $limit  The maximum number of messages to return; 1-20
     */
    public function __construct(
        protected int $user_id,
        protected int $limit,
    ) {}

    public function getMethod(): string
    {
        return 'getUserPersonalChatMessages';
    }

    public function validate(): void
    {
        if ($this->limit < 1 || $this->limit > 20) {
            throw new TelegramValidationException('limit must be between 1 and 20');
        }
    }

    public function buildParams(): array
    {
        return [
            'user_id' => $this->user_id,
            'limit' => $this->limit,
        ];
    }
}
