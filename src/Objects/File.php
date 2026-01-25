<?php

namespace Telegram\Bot\Objects;

/**
 * Class File. *
 */
class File extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * @param  string  $token  the bot token
     * @return string the http url of the file
     */
    public function getUrl(string $token): string
    {
        return 'https://api.telegram.org/file/bot'.$token.'/'.$this->getFilePath();
    }

    /**
     * Unique identifier for this file.
     */
    public function getFileId(): string
    {
        return $this->items['file_id'];
    }

    /**
     * (Optional). File size, if known.
     */
    public function getFileSize(): ?int
    {
        return $this->items['file_size'] ?? null;
    }

    /**
     * (Optional). File path. Use 'https://api.telegram.org/file/bot<token>/<file_path>' to get the file.
     */
    public function getFilePath(): ?string
    {
        return $this->items['file_path'] ?? null;
    }
}
