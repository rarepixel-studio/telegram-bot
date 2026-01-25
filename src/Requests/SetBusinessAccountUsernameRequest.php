<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the setBusinessAccountUsername method.
 *
 * Use this method to change the username of the business connection.
 *
 * @link https://core.telegram.org/bots/api#setbusinessaccountusername
 */
class SetBusinessAccountUsernameRequest extends TelegramApiRequest
{
    /**
     * @param  string  $business_connection_id  Unique identifier of the business connection
     */
    public function __construct(
        protected string $business_connection_id,
    ) {}

    protected array $params = [];

    public function username(string $username): self
    {
        $this->params['username'] = $username;

        return $this;
    }

    public function getMethod(): string
    {
        return 'setBusinessAccountUsername';
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
        ] + $this->params;
    }
}
