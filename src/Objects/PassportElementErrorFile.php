<?php

namespace Telegram\Bot\Objects;

/**
 * Class PassportElementErrorFile.
 *
 * Represents an issue with a document scan.
 * The error is considered resolved when the file with the document scan changes.
 *
 * @link https://core.telegram.org/bots/api#passportelementerrorfile
 */
class PassportElementErrorFile extends PassportElementError
{
    /**
     * Base64-encoded hash of the file with the document scan.
     */
    public function getFileHash(): string
    {
        return $this->items['file_hash'];
    }
}
