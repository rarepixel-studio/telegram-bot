<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the verifyUser method.
 *
 * Use this method to verify a user on behalf of the organization which is represented by the bot.
 *
 * @link https://core.telegram.org/bots/api#verifyuser
 */
class VerifyUserRequest extends TelegramApiRequest
{
    /**
     * @param  int  $user_id  Unique identifier of the target user
     * @param  string  $custom_description  Custom description for the verification
     */
    public function __construct(
        protected int $user_id,
        protected string $custom_description,
    ) {}

    public function getMethod(): string
    {
        return 'verifyUser';
    }

    public function validate(): void
    {
        if ($this->user_id <= 0) {
            throw new TelegramValidationException('user_id must be greater than 0');
        }
    }

    public function buildParams(): array
    {
        return [
            'user_id' => $this->user_id,
            'custom_description' => $this->custom_description,
        ];
    }
}
