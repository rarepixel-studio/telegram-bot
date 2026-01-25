<?php

namespace Telegram\Bot\Objects;

/**
 * Class VideoChatEnded.
 *
 * Represents a service message about a video chat ended in the chat.
 */
class VideoChatEnded extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Video chat duration in seconds.
     */
    public function getDuration(): int
    {
        return $this->items['duration'];
    }
}
