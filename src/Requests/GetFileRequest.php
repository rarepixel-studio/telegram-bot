<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the getFile method.
 *
 * Use this method to get basic information about a file and prepare it for downloading.
 * The file can then be downloaded via the link https://api.telegram.org/file/bot<token>/<file_path>,
 * where <file_path> is taken from the response.
 *
 * @link https://core.telegram.org/bots/api#getfile
 */
class GetFileRequest extends TelegramApiRequest
{
    /**
     * @param  string  $file_id  File identifier to get information about
     */
    public function __construct(
        protected string $file_id,
    ) {}

    public function getMethod(): string
    {
        return 'getFile';
    }

    public function validate(): void
    {
        if (empty($this->file_id)) {
            throw new TelegramValidationException('file_id cannot be empty');
        }
    }

    public function buildParams(): array
    {
        return [
            'file_id' => $this->file_id,
        ];
    }
}
