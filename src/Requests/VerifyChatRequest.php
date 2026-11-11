<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Traits\HasVerificationDescription;

/**
 * Request object for the verifyChat method.
 *
 * Use this method to verify a chat on behalf of the organization which is represented by the bot.
 *
 * @link https://core.telegram.org/bots/api#verifychat
 */
class VerifyChatRequest extends TelegramApiRequest
{
    use HasVerificationDescription;

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     * @param  string|null  $custom_description  Custom description for the verification
     */
    public function __construct(
        protected int|string $chat_id,
        protected ?string $custom_description = null,
    ) {}

    /**
     * {@inheritdoc}
     */
    public function getMethod(): string
    {
        return 'verifyChat';
    }

    /**
     * {@inheritdoc}
     *
     * @throws TelegramValidationException
     */
    public function validate(): void
    {
        $this->validateVerificationDescription();
    }

    /**
     * {@inheritdoc}
     */
    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'custom_description' => $this->custom_description,
        ] + $this->descriptionParams;
    }
}
