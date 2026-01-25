<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the answerInlineQuery method.
 *
 * Use this method to send answers to an inline query.
 *
 * @link https://core.telegram.org/bots/api#answerinlinequery
 */
class AnswerInlineQueryRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'results',
        'button',
    ];

    /**
     * @param  string  $inline_query_id  Unique identifier for the answered query
     * @param  array  $results  A JSON-serialized array of results for the inline query
     */
    public function __construct(
        protected string $inline_query_id,
        protected array $results,
    ) {}

    protected array $params = [];

    public function cacheTime(int $cache_time): self
    {
        $this->params['cache_time'] = $cache_time;

        return $this;
    }

    public function isPersonal(bool $is_personal): self
    {
        $this->params['is_personal'] = $is_personal;

        return $this;
    }

    public function nextOffset(string $next_offset): self
    {
        $this->params['next_offset'] = $next_offset;

        return $this;
    }

    public function button(array $button): self
    {
        $this->params['button'] = $button;

        return $this;
    }

    public function getMethod(): string
    {
        return 'answerInlineQuery';
    }

    public function validate(): void
    {
        if (empty($this->inline_query_id)) {
            throw new TelegramValidationException('inline_query_id cannot be empty');
        }
        if (empty($this->results)) {
            throw new TelegramValidationException('results cannot be empty');
        }
    }

    public function buildParams(): array
    {
        return [
            'inline_query_id' => $this->inline_query_id,
            'results' => $this->results,
        ] + $this->params;
    }
}
