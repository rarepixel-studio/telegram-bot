<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the declineSuggestedPost method.
 *
 * Use this method to decline a channel post suggested by a user.
 *
 * @link https://core.telegram.org/bots/api#declinesuggestedpost
 */
class DeclineSuggestedPostRequest extends TelegramApiRequest
{
    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     * @param  int  $message_id  Identifier of the suggested post to be declined
     */
    public function __construct(
        protected int|string $chat_id,
        protected int $message_id,
    ) {}

    public function getMethod(): string
    {
        return 'declineSuggestedPost';
    }

    public function validate(): void
    {
        // Basic type validation handled by PHP
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'message_id' => $this->message_id,
        ];
    }
}
