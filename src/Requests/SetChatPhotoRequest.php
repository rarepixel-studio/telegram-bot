<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\FileUpload\InputFile;

/**
 * Request object for the setChatPhoto method.
 *
 * Use this method to set a new profile photo for the chat.
 *
 * @link https://core.telegram.org/bots/api#setchatphoto
 */
class SetChatPhotoRequest extends TelegramApiRequest
{
    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     * @param  InputFile  $photo  New chat photo
     */
    public function __construct(
        protected int|string $chat_id,
        protected InputFile $photo,
    ) {}

    public function getMethod(): string
    {
        return 'setChatPhoto';
    }

    public function validate(): void
    {
        // No specific validation needed
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'photo' => $this->photo,
        ];
    }
}
