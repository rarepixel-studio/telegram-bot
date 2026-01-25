<?php

namespace Telegram\Bot\Objects;

/**
 * Class PassportElementErrorFiles.
 *
 * Represents an issue with a list of scans.
 * The error is considered resolved when the list of files containing the scans changes.
 *
 * @link https://core.telegram.org/bots/api#passportelementerrorfiles
 */
class PassportElementErrorFiles extends PassportElementError
{
    /**
     * List of base64-encoded hashes of the files with the document scans.
     *
     * @return string[]
     */
    public function getFileHashes(): array
    {
        return $this->items['file_hashes'];
    }
}
