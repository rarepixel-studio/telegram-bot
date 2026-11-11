<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Traits\HasVerificationDescription;

/**
 * Request object for the verifyUser method.
 *
 * Use this method to verify a user on behalf of the organization which is represented by the bot.
 *
 * @link https://core.telegram.org/bots/api#verifyuser
 */
class VerifyUserRequest extends TelegramApiRequest
{
    use HasVerificationDescription;

    /**
     * @param  int  $user_id  Unique identifier of the target user
     * @param  string|null  $custom_description  Custom description for the verification
     */
    public function __construct(
        protected int $user_id,
        protected ?string $custom_description = null,
    ) {}

    /**
     * {@inheritdoc}
     */
    public function getMethod(): string
    {
        return 'verifyUser';
    }

    /**
     * {@inheritdoc}
     *
     * @throws TelegramValidationException
     */
    public function validate(): void
    {
        if ($this->user_id <= 0) {
            throw new TelegramValidationException('user_id must be greater than 0');
        }

        $this->validateVerificationDescription();
    }

    /**
     * {@inheritdoc}
     */
    public function buildParams(): array
    {
        return [
            'user_id' => $this->user_id,
            'custom_description' => $this->custom_description,
        ] + $this->descriptionParams;
    }
}
