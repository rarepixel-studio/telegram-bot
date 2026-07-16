<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the deleteEphemeralMessage method.
 *
 * Use this method to delete an ephemeral message.
 *
 * @link https://core.telegram.org/bots/api#deleteephemeralmessage
 */
class DeleteEphemeralMessageRequest extends TelegramApiRequest
{
    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     * @param  string  $ephemeral_message_id  Identifier of the ephemeral message to delete
     */
    public function __construct(
        protected int|string $chat_id,
        protected string $ephemeral_message_id,
    ) {}

    public function getMethod(): string
    {
        return 'deleteEphemeralMessage';
    }

    public function validate(): void
    {
        // Basic validation
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'ephemeral_message_id' => $this->ephemeral_message_id,
        ];
    }
}
