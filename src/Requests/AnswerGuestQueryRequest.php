<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Objects\InlineQuery\InlineQueryResult;

/**
 * Request object for the answerGuestQuery method.
 *
 * Use this method to send a message in response to a guest bot query. Returns SentGuestMessage on success.
 *
 * @link https://core.telegram.org/bots/api#answerguestquery
 */
class AnswerGuestQueryRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'result',
    ];

    /**
     * @param  string  $guest_query_id  Unique identifier for the query to be answered
     * @param  array|InlineQueryResult  $result  A JSON-serialized object describing the message to be sent
     */
    public function __construct(
        protected string $guest_query_id,
        protected array|InlineQueryResult $result,
    ) {}

    public function getMethod(): string
    {
        return 'answerGuestQuery';
    }

    public function validate(): void
    {
        // No specific validation
    }

    public function buildParams(): array
    {
        return [
            'guest_query_id' => $this->guest_query_id,
            'result' => $this->result,
        ];
    }
}
