<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the deleteMessages method.
 *
 * Use this method to delete multiple messages simultaneously.
 *
 * @link https://core.telegram.org/bots/api#deletemessages
 */
class DeleteMessagesRequest extends TelegramApiRequest
{
    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     * @param  array  $message_ids  List of 1-100 identifiers of messages to delete
     */
    public function __construct(
        protected int|string $chat_id,
        protected array $message_ids,
    ) {}

    public function getMethod(): string
    {
        return 'deleteMessages';
    }

    public function validate(): void
    {
        if (empty($this->message_ids)) {
            throw new TelegramValidationException('message_ids cannot be empty');
        }
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'message_ids' => $this->message_ids,
        ];
    }
}
