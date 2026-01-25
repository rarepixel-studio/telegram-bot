<?php

namespace Telegram\Bot\Objects;

/**
 * Class PassportElementErrorFrontSide.
 *
 * Represents an issue with the front side of a document.
 * The error is considered resolved when the file with the front side of the document changes.
 *
 * @link https://core.telegram.org/bots/api#passportelementerrorfrontside
 */
class PassportElementErrorFrontSide extends PassportElementError
{
    /**
     * Base64-encoded hash of the file with the front side of the document.
     */
    public function getFileHash(): string
    {
        return $this->items['file_hash'];
    }
}
