<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the editEphemeralMessageReplyMarkup method.
 *
 * @link https://core.telegram.org/bots/api#editephemeralmessagereplymarkup
 */
class EditEphemeralMessageReplyMarkupRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'reply_markup',
    ];

    protected array $params = [];

    public function __construct() {}

    public function businessConnectionId(string $business_connection_id): self
    {
        $this->params['business_connection_id'] = $business_connection_id;

        return $this;
    }

    public function chatId(int|string $chat_id): self
    {
        $this->params['chat_id'] = $chat_id;

        return $this;
    }

    public function ephemeralMessageId(string $ephemeral_message_id): self
    {
        $this->params['ephemeral_message_id'] = $ephemeral_message_id;

        return $this;
    }

    public function replyMarkup(array $reply_markup): self
    {
        $this->params['reply_markup'] = $reply_markup;

        return $this;
    }

    public function getMethod(): string
    {
        return 'editEphemeralMessageReplyMarkup';
    }

    public function validate(): void
    {
        // Validation logic for identifiers
    }

    public function buildParams(): array
    {
        return $this->params;
    }
}
