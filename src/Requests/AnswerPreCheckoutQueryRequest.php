<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the answerPreCheckoutQuery method.
 *
 * Use this method to respond to such pre-checkout queries.
 *
 * @link https://core.telegram.org/bots/api#answerprecheckoutquery
 */
class AnswerPreCheckoutQueryRequest extends TelegramApiRequest
{
    /**
     * @param  string  $pre_checkout_query_id  Unique identifier for the query to be answered
     * @param  bool  $ok  Specify True if everything is alright or False if there are problems
     */
    public function __construct(
        protected string $pre_checkout_query_id,
        protected bool $ok,
    ) {}

    protected array $params = [];

    public function errorMessage(string $error_message): self
    {
        $this->params['error_message'] = $error_message;

        return $this;
    }

    public function getMethod(): string
    {
        return 'answerPreCheckoutQuery';
    }

    public function validate(): void
    {
        if (empty($this->pre_checkout_query_id)) {
            throw new TelegramValidationException('pre_checkout_query_id cannot be empty');
        }
    }

    public function buildParams(): array
    {
        return [
            'pre_checkout_query_id' => $this->pre_checkout_query_id,
            'ok' => $this->ok,
        ] + $this->params;
    }
}
