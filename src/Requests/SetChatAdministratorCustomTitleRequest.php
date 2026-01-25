<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the setChatAdministratorCustomTitle method.
 *
 * Use this method to set a custom title for an administrator in a supergroup promoted by the bot.
 *
 * @link https://core.telegram.org/bots/api#setchatadministratorcustomtitle
 */
class SetChatAdministratorCustomTitleRequest extends TelegramApiRequest
{
    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target supergroup
     * @param  int  $user_id  Unique identifier of the target user
     * @param  string  $custom_title  New custom title for the administrator; 0-16 characters, emoji are not allowed
     */
    public function __construct(
        protected int|string $chat_id,
        protected int $user_id,
        protected string $custom_title,
    ) {}

    public function getMethod(): string
    {
        return 'setChatAdministratorCustomTitle';
    }

    public function validate(): void
    {
        if ($this->user_id <= 0) {
            throw new TelegramValidationException('user_id must be greater than 0');
        }

        $titleLength = mb_strlen($this->custom_title);
        if ($titleLength > 16) {
            throw new TelegramValidationException('custom_title must not exceed 16 characters');
        }
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'user_id' => $this->user_id,
            'custom_title' => $this->custom_title,
        ];
    }
}
