<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the verifyChat method.
 *
 * Use this method to verify a chat on behalf of the organization which is represented by the bot.
 *
 * @link https://core.telegram.org/bots/api#verifychat
 */
class VerifyChatRequest extends TelegramApiRequest
{
    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     * @param  string  $custom_description  Custom description for the verification
     */
    public function __construct(
        protected int|string $chat_id,
        protected string $custom_description,
    ) {}

    public function getMethod(): string
    {
        return 'verifyChat';
    }

    public function validate(): void
    {
        // No additional validation needed
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'custom_description' => $this->custom_description,
        ];
    }
}
