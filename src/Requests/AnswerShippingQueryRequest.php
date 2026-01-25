<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the answerShippingQuery method.
 *
 * Use this method to reply to shipping queries.
 *
 * @link https://core.telegram.org/bots/api#answershippingquery
 */
class AnswerShippingQueryRequest extends TelegramApiRequest
{
    /**
     * @param  string  $shipping_query_id  Unique identifier for the query to be answered
     * @param  bool  $ok  Specify True if delivery to the specified address is possible and False if there are any problems
     */
    public function __construct(
        protected string $shipping_query_id,
        protected bool $ok,
    ) {}

    protected array $params = [];

    public function shippingOptions(array $shipping_options): self
    {
        $this->params['shipping_options'] = $shipping_options;

        return $this;
    }

    public function errorMessage(string $error_message): self
    {
        $this->params['error_message'] = $error_message;

        return $this;
    }

    public function getMethod(): string
    {
        return 'answerShippingQuery';
    }

    public function validate(): void
    {
        if (empty($this->shipping_query_id)) {
            throw new TelegramValidationException('shipping_query_id cannot be empty');
        }
    }

    public function buildParams(): array
    {
        return [
            'shipping_query_id' => $this->shipping_query_id,
            'ok' => $this->ok,
        ] + $this->params;
    }
}
