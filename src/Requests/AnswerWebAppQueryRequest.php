<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the answerWebAppQuery method.
 *
 * Use this method to set the result of an interaction with a Web App and send a corresponding message
 * on behalf of the user to the chat from which the query originated.
 *
 * @link https://core.telegram.org/bots/api#answerwebappquery
 */
class AnswerWebAppQueryRequest extends TelegramApiRequest
{
    /**
     * @param  string  $web_app_query_id  Unique identifier for the query to be answered
     * @param  array  $result  A JSON-serialized object describing the message to be sent
     */
    public function __construct(
        protected string $web_app_query_id,
        protected array $result,
    ) {}

    public function getMethod(): string
    {
        return 'answerWebAppQuery';
    }

    public function validate(): void
    {
        if (empty($this->web_app_query_id)) {
            throw new TelegramValidationException('web_app_query_id cannot be empty');
        }
        if (empty($this->result)) {
            throw new TelegramValidationException('result cannot be empty');
        }
    }

    public function buildParams(): array
    {
        return [
            'web_app_query_id' => $this->web_app_query_id,
            'result' => json_encode($this->result),
        ];
    }
}
