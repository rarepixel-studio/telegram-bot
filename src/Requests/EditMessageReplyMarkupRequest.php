<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the editMessageReplyMarkup method.
 *
 * Use this method to edit only the reply markup of messages.
 *
 * @link https://core.telegram.org/bots/api#editmessagereplymarkup
 */
class EditMessageReplyMarkupRequest extends TelegramApiRequest
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

    public function messageId(int $message_id): self
    {
        $this->params['message_id'] = $message_id;

        return $this;
    }

    public function inlineMessageId(string $inline_message_id): self
    {
        $this->params['inline_message_id'] = $inline_message_id;

        return $this;
    }

    public function replyMarkup(array $reply_markup): self
    {
        $this->params['reply_markup'] = $reply_markup;

        return $this;
    }

    public function getMethod(): string
    {
        return 'editMessageReplyMarkup';
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
