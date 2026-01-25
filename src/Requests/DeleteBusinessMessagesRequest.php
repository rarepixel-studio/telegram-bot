<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the deleteBusinessMessages method.
 *
 * Use this method to delete messages sent by the bot business connection.
 *
 * @link https://core.telegram.org/bots/api#deletebusinessmessages
 */
class DeleteBusinessMessagesRequest extends TelegramApiRequest
{
    /**
     * @param  string  $business_connection_id  Unique identifier of the business connection
     * @param  array  $message_ids  List of message identifiers to delete
     */
    public function __construct(
        protected string $business_connection_id,
        protected array $message_ids,
    ) {}

    /**
     * Unique identifier of the chat.
     */
    public function chatId(int|string $chat_id): self
    {
        return $this;
    }

    public function getMethod(): string
    {
        return 'deleteBusinessMessages';
    }

    public function validate(): void
    {
        if (empty($this->business_connection_id)) {
            throw new TelegramValidationException('business_connection_id cannot be empty');
        }
        if (empty($this->message_ids)) {
            throw new TelegramValidationException('message_ids cannot be empty');
        }
    }

    public function buildParams(): array
    {
        return [
            'business_connection_id' => $this->business_connection_id,
            'message_ids' => $this->message_ids,
        ];
    }
}
