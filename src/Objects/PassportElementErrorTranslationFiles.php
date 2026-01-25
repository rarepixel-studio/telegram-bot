<?php

namespace Telegram\Bot\Objects;

/**
 * Class PassportElementErrorTranslationFiles.
 *
 * Represents an issue with the translated version of a document.
 * The error is considered resolved when the list of files containing the translations changes.
 *
 * @link https://core.telegram.org/bots/api#passportelementerrortranslationfiles
 */
class PassportElementErrorTranslationFiles extends PassportElementError
{
    /**
     * List of base64-encoded hashes of the files with the translations.
     *
     * @return string[]
     */
    public function getFileHashes(): array
    {
        return $this->items['file_hashes'];
    }
}
