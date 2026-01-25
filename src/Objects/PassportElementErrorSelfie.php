<?php

namespace Telegram\Bot\Objects;

/**
 * Class PassportElementErrorSelfie.
 *
 * Represents an issue with the selfie with a document.
 * The error is considered resolved when the file with the selfie changes.
 *
 * @link https://core.telegram.org/bots/api#passportelementerrorselfie
 */
class PassportElementErrorSelfie extends PassportElementError
{
    /**
     * Base64-encoded hash of the file with the selfie.
     */
    public function getFileHash(): string
    {
        return $this->items['file_hash'];
    }
}
