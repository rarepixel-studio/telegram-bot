<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\FileUpload\InputFile;

/**
 * Request object for the setBusinessAccountProfilePhoto method.
 *
 * Use this method to change the profile photo of the business connection.
 *
 * @link https://core.telegram.org/bots/api#setbusinessaccountprofilephoto
 */
class SetBusinessAccountProfilePhotoRequest extends TelegramApiRequest
{
    /**
     * @param  string  $business_connection_id  Unique identifier of the business connection
     * @param  InputFile|string  $photo  New profile photo, file or file_id
     */
    public function __construct(
        protected string $business_connection_id,
        protected InputFile|string $photo,
    ) {}

    public function getMethod(): string
    {
        return 'setBusinessAccountProfilePhoto';
    }

    public function validate(): void
    {
        if (empty($this->business_connection_id)) {
            throw new TelegramValidationException('business_connection_id cannot be empty');
        }
    }

    public function buildParams(): array
    {
        return [
            'business_connection_id' => $this->business_connection_id,
            'photo' => $this->photo,
        ];
    }
}
