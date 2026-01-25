<?php

namespace Telegram\Bot\Objects;

/**
 * Class PassportElementErrorReverseSide.
 *
 * Represents an issue with the reverse side of a document.
 * The error is considered resolved when the file with the reverse side of the document changes.
 *
 * @link https://core.telegram.org/bots/api#passportelementerrorreverseside
 */
class PassportElementErrorReverseSide extends PassportElementError
{
    /**
     * Base64-encoded hash of the file with the reverse side of the document.
     */
    public function getFileHash(): string
    {
        return $this->items['file_hash'];
    }
}
