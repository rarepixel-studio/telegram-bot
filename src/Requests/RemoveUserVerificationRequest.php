<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the removeUserVerification method.
 *
 * Use this method to remove verification from a user.
 *
 * @link https://core.telegram.org/bots/api#removeuserverification
 */
class RemoveUserVerificationRequest extends TelegramApiRequest
{
    /**
     * @param  int  $user_id  Unique identifier of the target user
     */
    public function __construct(
        protected int $user_id,
    ) {}

    public function getMethod(): string
    {
        return 'removeUserVerification';
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
        ];
    }
}
