<?php

namespace Telegram\Bot\Objects;

/**
 * Class Animation. *
 */
class Animation extends Document
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Video width as defined by sender.
     */
    public function getWidth(): int
    {
        return $this->items['width'];
    }

    /**
     * Video height as defined by sender.
     */
    public function getHeight(): int
    {
        return $this->items['height'];
    }

    /**
     * Duration of the video in seconds as defined by sender.
     */
    public function getDuration(): int
    {
        return $this->items['duration'];
    }
}
