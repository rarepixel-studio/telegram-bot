<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the unpinAllForumTopicMessages method.
 *
 * Use this method to clear the list of pinned messages in a forum topic.
 *
 * @link https://core.telegram.org/bots/api#unpinallforumtopicmessages
 */
class UnpinAllForumTopicMessagesRequest extends TelegramApiRequest
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
        return 'unpinAllForumTopicMessages';
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
