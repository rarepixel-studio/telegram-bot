<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the sendChatJoinRequestWebApp method.
 *
 * @link https://core.telegram.org/bots/api#sendchatjoinrequestwebapp
 */
class SendChatJoinRequestWebAppRequest extends TelegramApiRequest
{
    /**
     * @param  string  $chat_join_request_query_id  Unique identifier of the join request query
     * @param  string  $web_app_url  The URL of the Mini App to be opened
     */
    public function __construct(
        protected string $chat_join_request_query_id,
        protected string $web_app_url,
    ) {}

    public function getMethod(): string
    {
        return 'sendChatJoinRequestWebApp';
    }

    public function validate(): void
    {
        if ($this->chat_join_request_query_id === '') {
            throw new TelegramValidationException('chat_join_request_query_id cannot be empty');
        }

        if (filter_var($this->web_app_url, FILTER_VALIDATE_URL) === false) {
            throw new TelegramValidationException('web_app_url must be a valid URL');
        }
    }

    public function buildParams(): array
    {
        return [
            'chat_join_request_query_id' => $this->chat_join_request_query_id,
            'web_app_url' => $this->web_app_url,
        ];
    }
}
