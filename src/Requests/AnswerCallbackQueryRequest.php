<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the answerCallbackQuery method.
 *
 * Use this method to send answers to callback queries sent from inline keyboards.
 *
 * @link https://core.telegram.org/bots/api#answercallbackquery
 */
class AnswerCallbackQueryRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  string  $callback_query_id  Unique identifier for the query to be answered
     */
    public function __construct(
        protected string $callback_query_id,
    ) {}

    /**
     * Text of the notification (0-200 characters).
     */
    public function text(string $text): self
    {
        $this->params['text'] = $text;

        return $this;
    }

    /**
     * If true, an alert will be shown by the client instead of a notification.
     */
    public function showAlert(bool $show_alert): self
    {
        $this->params['show_alert'] = $show_alert;

        return $this;
    }

    /**
     * URL that will be opened by the user's client.
     */
    public function url(string $url): self
    {
        $this->params['url'] = $url;

        return $this;
    }

    /**
     * Maximum time in seconds that the result may be cached client-side.
     */
    public function cacheTime(int $cache_time): self
    {
        $this->params['cache_time'] = $cache_time;

        return $this;
    }

    public function getMethod(): string
    {
        return 'answerCallbackQuery';
    }

    public function validate(): void
    {
        if (empty($this->callback_query_id)) {
            throw new TelegramValidationException('callback_query_id cannot be empty');
        }

        if (isset($this->params['text'])) {
            $textLength = mb_strlen($this->params['text']);
            if ($textLength > 200) {
                throw new TelegramValidationException('text must not exceed 200 characters');
            }
        }
    }

    public function buildParams(): array
    {
        return [
            'callback_query_id' => $this->callback_query_id,
        ] + $this->params;
    }
}
