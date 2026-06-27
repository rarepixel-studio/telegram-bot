<?php

namespace Telegram\Bot\Objects;

/**
 * Class InputMediaLink.
 *
 * Represents an HTTP link to be sent.
 *
 * @link https://core.telegram.org/bots/api#inputmedialink
 */
class InputMediaLink extends InputMedia
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Type of the media, always link.
     */
    public function getType(): string
    {
        return $this->items['type'] ?? 'link';
    }

    /**
     * HTTP URL of the link.
     */
    public function getUrl(): string
    {
        return $this->items['url'];
    }
}
