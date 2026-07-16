<?php

namespace Telegram\Bot\Objects;

/**
 * Class InputRichMessageMedia.
 *
 * Represents media used in markdown or html formatting when sending a rich message.
 *
 * @link https://core.telegram.org/bots/api#inputrichmessagemedia
 */
class InputRichMessageMedia extends InputMedia
{
    /**
     * Type of the media.
     */
    public function getType(): string
    {
        return $this->items['type'];
    }

    /**
     * File to send.
     */
    public function getMedia(): string
    {
        return $this->items['media'];
    }

    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}
