<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the setChatTitle method.
 *
 * Use this method to change the title of a chat.
 *
 * @link https://core.telegram.org/bots/api#setchattitle
 */
class SetChatTitleRequest extends TelegramApiRequest
{
    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     * @param  string  $title  New chat title, 1-128 characters
     */
    public function __construct(
        protected int|string $chat_id,
        protected string $title,
    ) {}

    public function getMethod(): string
    {
        return 'setChatTitle';
    }

    public function validate(): void
    {
        $titleLength = mb_strlen($this->title);

        if ($titleLength < 1 || $titleLength > 255) {
            throw new TelegramValidationException('title must be between 1 and 255 characters');
        }
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'title' => $this->title,
        ];
    }
}
