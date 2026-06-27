<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the answerChatJoinRequestQuery method.
 *
 * @link https://core.telegram.org/bots/api#answerchatjoinrequestquery
 */
class AnswerChatJoinRequestQueryRequest extends TelegramApiRequest
{
    private const VALID_RESULTS = ['approve', 'decline', 'queue'];

    /**
     * @param  string  $chat_join_request_query_id  Unique identifier of the join request query
     * @param  string  $result  Query result: approve, decline, or queue
     */
    public function __construct(
        protected string $chat_join_request_query_id,
        protected string $result,
    ) {}

    public function getMethod(): string
    {
        return 'answerChatJoinRequestQuery';
    }

    public function validate(): void
    {
        if ($this->chat_join_request_query_id === '') {
            throw new TelegramValidationException('chat_join_request_query_id cannot be empty');
        }

        if (! in_array($this->result, self::VALID_RESULTS, true)) {
            throw new TelegramValidationException('result must be approve, decline, or queue');
        }
    }

    public function buildParams(): array
    {
        return [
            'chat_join_request_query_id' => $this->chat_join_request_query_id,
            'result' => $this->result,
        ];
    }
}
