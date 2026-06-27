<?php

namespace Telegram\Bot\Objects;

/**
 * Class Link.
 *
 * Represents an HTTP link.
 *
 * @link https://core.telegram.org/bots/api#link
 */
class Link extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * URL of the link.
     */
    public function getUrl(): string
    {
        return $this->items['url'];
    }
}
