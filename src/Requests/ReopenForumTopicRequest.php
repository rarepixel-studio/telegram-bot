<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the reopenForumTopic method.
 *
 * Use this method to reopen a closed topic in a forum supergroup chat.
 *
 * @link https://core.telegram.org/bots/api#reopenforumtopic
 */
class ReopenForumTopicRequest extends TelegramApiRequest
{
    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target supergroup
     * @param  int  $message_thread_id  Unique identifier for the target message thread of the forum topic
     */
    public function __construct(
        protected int|string $chat_id,
        protected int $message_thread_id,
    ) {}

    public function getMethod(): string
    {
        return 'reopenForumTopic';
    }

    public function validate(): void
    {
        if ($this->message_thread_id <= 0) {
            throw new TelegramValidationException('message_thread_id must be greater than 0');
        }
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'message_thread_id' => $this->message_thread_id,
        ];
    }
}
