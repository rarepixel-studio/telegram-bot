<?php

namespace Telegram\Bot\Objects\InlineQuery;

/**
 * Class InlineQueryResultArticle.
 *
 * Represents a link to an article or web page.
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultarticle
 */
class InlineQueryResultArticle extends InlineQueryResult
{
    public function __construct($params = [])
    {
        parent::__construct($params);
        $this->put('type', 'article');
    }

    /**
     * Title of the result.
     */
    public function getTitle(): string
    {
        return $this->items['title'];
    }

    /**
     * (Optional). URL of the result.
     */
    public function getUrl(): ?string
    {
        return $this->items['url'] ?? null;
    }

    /**
     * (Optional). Pass True if you don't want the URL to be shown in the message.
     */
    public function getHideUrl(): ?bool
    {
        return $this->items['hide_url'] ?? null;
    }

    /**
     * (Optional). Short description of the result.
     */
    public function getDescription(): ?string
    {
        return $this->items['description'] ?? null;
    }

    /**
     * (Optional). URL of the thumbnail for the result.
     */
    public function getThumbUrl(): ?string
    {
        return $this->items['thumb_url'] ?? null;
    }

    /**
     * (Optional). Thumbnail width.
     */
    public function getThumbWidth(): ?int
    {
        return $this->items['thumb_width'] ?? null;
    }

    /**
     * (Optional). Thumbnail height.
     */
    public function getThumbHeight(): ?int
    {
        return $this->items['thumb_height'] ?? null;
    }
}
