<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the readBusinessMessage method.
 *
 * Use this method to tell the server that the bot has read all messages faster than a specific date.
 *
 * @link https://core.telegram.org/bots/api#readbusinessmessage
 */
class ReadBusinessMessageRequest extends TelegramApiRequest
{
    /**
     * @param  string  $business_connection_id  Unique identifier of the business connection
     */
    public function __construct(
        protected string $business_connection_id,
    ) {}

    public function getMethod(): string
    {
        return 'readBusinessMessage';
    }

    public function validate(): void
    {
        if (empty($this->business_connection_id)) {
            throw new TelegramValidationException('business_connection_id cannot be empty');
        }
    }

    public function buildParams(): array
    {
        return [
            'business_connection_id' => $this->business_connection_id,
        ];
    }
}
