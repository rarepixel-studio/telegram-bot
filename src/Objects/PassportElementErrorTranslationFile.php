<?php

namespace Telegram\Bot\Objects;

/**
 * Class PassportElementErrorTranslationFile.
 *
 * Represents an issue with one of the files that constitute the translation of a document.
 * The error is considered resolved when the file changes.
 *
 * @link https://core.telegram.org/bots/api#passportelementerrortranslationfile
 */
class PassportElementErrorTranslationFile extends PassportElementError
{
    /**
     * Base64-encoded hash of the file with the translation.
     */
    public function getFileHash(): string
    {
        return $this->items['file_hash'];
    }
}
