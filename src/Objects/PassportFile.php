<?php

namespace Telegram\Bot\Objects;

/**
 * Class PassportFile.
 *
 * This object represents a file uploaded to Telegram Passport.
 *
 * @link https://core.telegram.org/bots/api#passportfile
 */
class PassportFile extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Identifier for this file, which can be used to download or reuse the file.
     */
    public function getFileId(): string
    {
        return $this->items['file_id'];
    }

    /**
     * Unique identifier for this file, which is supposed to be the same over time and for different bots.
     */
    public function getFileUniqueId(): string
    {
        return $this->items['file_unique_id'];
    }

    /**
     * File size in bytes.
     */
    public function getFileSize(): int
    {
        return $this->items['file_size'];
    }

    /**
     * Unix time when the file was uploaded.
     */
    public function getFileDate(): int
    {
        return $this->items['file_date'];
    }
}
