<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the setBusinessAccountBio method.
 *
 * Use this method to change the bio of the business connection.
 *
 * @link https://core.telegram.org/bots/api#setbusinessaccountbio
 */
class SetBusinessAccountBioRequest extends TelegramApiRequest
{
    /**
     * @param  string  $business_connection_id  Unique identifier of the business connection
     */
    public function __construct(
        protected string $business_connection_id,
    ) {}

    protected array $params = [];

    public function bio(string $bio): self
    {
        $this->params['bio'] = $bio;

        return $this;
    }

    public function getMethod(): string
    {
        return 'setBusinessAccountBio';
    }

    public function validate(): void
    {
        if (empty($this->business_connection_id)) {
            throw new TelegramValidationException('business_connection_id cannot be empty');
        }
        if (isset($this->params['bio']) && mb_strlen($this->params['bio']) > 156) {
            throw new TelegramValidationException('bio must not exceed 156 characters');
        }
    }

    public function buildParams(): array
    {
        return [
            'business_connection_id' => $this->business_connection_id,
        ] + $this->params;
    }
}
