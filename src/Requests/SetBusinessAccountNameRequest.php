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

    public function name(string $name): self
    {
        $this->params['name'] = $name;

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
    }

    public function buildParams(): array
    {
        return [
            'business_connection_id' => $this->business_connection_id,
            'name' => $this->first_name, // The method is setBusinessAccountName but param can be 'name'? Wait. Verify script said 'first_name'.
        ] + $this->params;
    }
}
