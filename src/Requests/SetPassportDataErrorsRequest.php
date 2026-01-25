<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the setPassportDataErrors method.
 *
 * Use this method to inform a user that some of the Telegram Passport elements they provided contains errors.
 *
 * @link https://core.telegram.org/bots/api#setpassportdataerrors
 */
class SetPassportDataErrorsRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'errors',
    ];

    /**
     * @param  int  $user_id  User identifier
     * @param  array  $errors  A JSON-serialized array describing the errors
     */
    public function __construct(
        protected int $user_id,
        protected array $errors,
    ) {}

    public function getMethod(): string
    {
        return 'setPassportDataErrors';
    }

    public function validate(): void
    {
        if ($this->user_id <= 0) {
            throw new TelegramValidationException('user_id must be greater than 0');
        }
        if (empty($this->errors)) {
            throw new TelegramValidationException('errors cannot be empty');
        }
    }

    public function buildParams(): array
    {
        return [
            'user_id' => $this->user_id,
            'errors' => $this->errors,
        ];
    }
}
