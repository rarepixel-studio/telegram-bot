<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the editMessageCaption method.
 *
 * Use this method to edit captions of messages.
 *
 * @link https://core.telegram.org/bots/api#editmessagecaption
 */
class EditMessageCaptionRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'caption_entities',
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

    public function caption(string $caption): self
    {
        $this->params['caption'] = $caption;

        return $this;
    }

    public function parseMode(string $parse_mode): self
    {
        $this->params['parse_mode'] = $parse_mode;

        return $this;
    }

    public function captionEntities(array $caption_entities): self
    {
        $this->params['caption_entities'] = $caption_entities;

        return $this;
    }

    public function replyMarkup(array $reply_markup): self
    {
        $this->params['reply_markup'] = $reply_markup;

        return $this;
    }

    public function getMethod(): string
    {
        return 'editMessageCaption';
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
