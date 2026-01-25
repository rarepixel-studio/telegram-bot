<?php

namespace Telegram\Bot\Objects\InlineQuery;

/**
 * Class InlineQueryResultCachedSticker.
 *
 * Represents a link to a sticker stored on Telegram servers.
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultcachedsticker
 */
class InlineQueryResultCachedSticker extends InlineQueryResult
{
    public function __construct($params = [])
    {
        parent::__construct($params);
        $this->put('type', 'sticker');
    }

    /**
     * A valid file identifier for the sticker.
     */
    public function getStickerFileId(): string
    {
        return $this->items['sticker_file_id'];
    }
}
