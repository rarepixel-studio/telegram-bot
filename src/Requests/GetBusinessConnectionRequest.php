<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the getBusinessConnection method.
 *
 * Use this method to get information about the connection of the bot with a business account.
 *
 * @link https://core.telegram.org/bots/api#getbusinessconnection
 */
class GetBusinessConnectionRequest extends TelegramApiRequest
{
    /**
     * @param  string  $business_connection_id  Unique identifier of the business connection
     */
    public function __construct(
        protected string $business_connection_id,
    ) {}

    public function getMethod(): string
    {
        return 'getBusinessConnection';
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
