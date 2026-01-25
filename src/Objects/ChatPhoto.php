<?php

namespace Telegram\Bot\Objects;

/**
 * Class ChatPhoto.
 */
class ChatPhoto extends BaseObject
{
    /**
     * Property relations.
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Unique file identifier of small (160x160) chat photo. This file_id can be used only for photo download.
     */
    public function getSmallFileId(): string
    {
        return $this->items['small_file_id'];
    }

    /**
     * Unique file identifier of big (640x640) chat photo. This file_id can be used only for photo download.
     */
    public function getBigFileId(): string
    {
        return $this->items['big_file_id'];
    }
}
