<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the approveSuggestedPost method.
 *
 * Use this method to approve a channel post suggested by a user.
 *
 * @link https://core.telegram.org/bots/api#approvesuggestedpost
 */
class ApproveSuggestedPostRequest extends TelegramApiRequest
{
    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     * @param  int  $message_id  Identifier of the suggested post to be approved
     */
    public function __construct(
        protected int|string $chat_id,
        protected int $message_id,
    ) {}

    public function getMethod(): string
    {
        return 'approveSuggestedPost';
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
