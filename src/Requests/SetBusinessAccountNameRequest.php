<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the setBusinessAccountName method.
 *
 * Use this method to change the name of the business connection.
 *
 * @link https://core.telegram.org/bots/api#setbusinessaccountname
 */
class SetBusinessAccountNameRequest extends TelegramApiRequest
{
    /**
     * @param  string  $business_connection_id  Unique identifier of the business connection
     */
    public function __construct(
        protected string $business_connection_id,
        protected string $first_name,
    ) {}

    protected array $params = [];

    /**
     * @param  string|null  $last_name  The new value of the last name for the business account
     */
    public function lastName(?string $last_name): self
    {
        $this->params['last_name'] = $last_name;

        return $this;
    }

    public function getMethod(): string
    {
        return 'setBusinessAccountName';
    }

    public function validate(): void
    {
        if (empty($this->business_connection_id)) {
            throw new TelegramValidationException('business_connection_id cannot be empty');
        }
        if (empty($this->first_name)) {
            throw new TelegramValidationException('first_name cannot be empty');
        }
        if (mb_strlen($this->first_name) > 64) {
            throw new TelegramValidationException('first_name must not exceed 64 characters');
        }
        if (isset($this->params['last_name']) && ! is_null($this->params['last_name']) && mb_strlen($this->params['last_name']) > 64) {
            throw new TelegramValidationException('last_name must not exceed 64 characters');
        }
    }

    public function buildParams(): array
    {
        return [
            'business_connection_id' => $this->business_connection_id,
            'first_name' => $this->first_name,
        ] + $this->params;
    }
}
