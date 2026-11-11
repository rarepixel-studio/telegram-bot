<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Edit the data of a widget in a message.
 *
 * @link https://core.telegram.org/bots/api#editmessagewidgetdata
 */
class EditMessageWidgetDataRequest extends TelegramApiRequest
{
    /** @var array<string, mixed> Additional request parameters. */
    protected array $params = [];

    /**
     * Build a request from Telegram parameter names.
     *
     * @param  array<string, mixed>  $params  Telegram request parameters
     * @return self The request object
     */
    public static function fromArray(array $params): self
    {
        $request = new self;
        $request->params = $params;

        return $request;
    }

    /**
     * Set the target chat ID or username.
     *
     * @param  int|string  $chatId  Target chat ID or username
     * @return $this
     */
    public function chatId(int|string $chatId): self
    {
        $this->params['chat_id'] = $chatId;

        return $this;
    }

    /**
     * Set the message identifier.
     *
     * @param  int  $messageId  Message identifier
     * @return $this
     */
    public function messageId(int $messageId): self
    {
        $this->params['message_id'] = $messageId;

        return $this;
    }

    /**
     * Set the inline message identifier.
     *
     * @param  string  $inlineMessageId  Inline message identifier
     * @return $this
     */
    public function inlineMessageId(string $inlineMessageId): self
    {
        $this->params['inline_message_id'] = $inlineMessageId;

        return $this;
    }

    /**
     * Set the public data visible wherever the widget appears.
     *
     * @param  string  $publicData  Public data visible wherever the widget appears
     * @return $this
     */
    public function publicData(string $publicData): self
    {
        $this->params['public_data'] = $publicData;

        return $this;
    }

    /**
     * Set the data specific to this widget message.
     *
     * @param  string  $chatData  Data specific to this widget message
     * @return $this
     */
    public function chatData(string $chatData): self
    {
        $this->params['chat_data'] = $chatData;

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getMethod(): string
    {
        return 'editMessageWidgetData';
    }

    /**
     * {@inheritdoc}
     *
     * @throws TelegramValidationException
     */
    public function validate(): void
    {
        $chatId = $this->params['chat_id'] ?? null;
        $messageId = $this->params['message_id'] ?? null;
        $inlineMessageId = $this->params['inline_message_id'] ?? null;

        if ($inlineMessageId === null) {
            if ((! is_int($chatId) && ! is_string($chatId)) || $chatId === '' || $chatId === 0 || ! is_int($messageId) || $messageId <= 0) {
                throw new TelegramValidationException('chat_id and message_id are required when inline_message_id is omitted');
            }
        } elseif (! is_string($inlineMessageId) || $inlineMessageId === '' || $chatId !== null || $messageId !== null) {
            throw new TelegramValidationException('inline_message_id must be non-empty and used without chat_id or message_id');
        }

        foreach (['public_data', 'chat_data'] as $field) {
            if (isset($this->params[$field]) && (! is_string($this->params[$field]) || strlen($this->params[$field]) > 1024)) {
                throw new TelegramValidationException($field.' must be a string of up to 1024 bytes');
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function buildParams(): array
    {
        return $this->params;
    }
}
