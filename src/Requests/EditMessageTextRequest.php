<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the editMessageText method.
 *
 * Use this method to edit text and game messages.
 *
 * @link https://core.telegram.org/bots/api#editmessagetext
 */
class EditMessageTextRequest extends TelegramApiRequest
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

    public function text(string $text): self
    {
        $this->params['text'] = $text;

        return $this;
    }

    public function parseMode(string $parse_mode): self
    {
        $this->params['parse_mode'] = $parse_mode;

        return $this;
    }

    public function entities(array $entities): self
    {
        $this->params['entities'] = $entities;

        return $this;
    }

    public function linkPreviewOptions(array $link_preview_options): self
    {
        $this->params['link_preview_options'] = $link_preview_options;

        return $this;
    }

    public function replyMarkup(array $reply_markup): self
    {
        $this->params['reply_markup'] = $reply_markup;

        return $this;
    }

    public function getMethod(): string
    {
        return 'editMessageText';
    }

    public function validate(): void
    {
        // Validation logic for chat_id+message_id OR inline_message_id could go here
    }

    public function buildParams(): array
    {
        return $this->params;
    }
}
