<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the stopMessageLiveLocation method.
 *
 * Use this method to stop updating a live location message.
 *
 * @link https://core.telegram.org/bots/api#stopmessagelivelocation
 */
class StopMessageLiveLocationRequest extends TelegramApiRequest
{
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
        return 'stopMessageLiveLocation';
    }

    public function validate(): void
    {
        // Validation needed
    }

    public function buildParams(): array
    {
        return $this->params;
    }
}
