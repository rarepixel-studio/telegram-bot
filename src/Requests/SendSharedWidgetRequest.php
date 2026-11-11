<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Send an existing shared widget created by the bot.
 *
 * @link https://core.telegram.org/bots/api#sendsharedwidget
 */
class SendSharedWidgetRequest extends SendWidgetMessageRequest
{
    /**
     * @param  int|string  $chatId  Target chat ID or username
     * @param  string  $widgetId  Shared widget identifier
     */
    public function __construct(
        protected int|string $chatId,
        protected string $widgetId,
    ) {}

    /**
     * Build a request from Telegram parameter names.
     *
     * @param  array<string, mixed>  $params  Telegram request parameters
     * @return self The request object
     *
     * @throws TelegramValidationException
     */
    public static function fromArray(array $params): self
    {
        $chatId = $params['chat_id'] ?? null;
        if (! is_int($chatId) && ! is_string($chatId)) {
            throw new TelegramValidationException('chat_id is required and must be an integer or a string');
        }

        $widgetId = $params['widget_id'] ?? null;
        if (! is_string($widgetId)) {
            throw new TelegramValidationException('widget_id is required and must be a string');
        }

        $request = new self($chatId, $widgetId);
        $request->params = array_diff_key($params, array_flip(['chat_id', 'widget_id']));

        return $request;
    }

    /**
     * {@inheritdoc}
     */
    public function getMethod(): string
    {
        return 'sendSharedWidget';
    }

    /**
     * {@inheritdoc}
     *
     * @throws TelegramValidationException
     */
    public function validate(): void
    {
        if ($this->chatId === '' || $this->chatId === 0) {
            throw new TelegramValidationException('chat_id must identify the target chat');
        }

        if ($this->widgetId === '') {
            throw new TelegramValidationException('widget_id cannot be empty');
        }

        $this->validateWidgetMessageOptions();
    }

    /**
     * {@inheritdoc}
     */
    protected function buildParams(): array
    {
        return [
            'chat_id' => $this->chatId,
            'widget_id' => $this->widgetId,
        ] + $this->params;
    }
}
