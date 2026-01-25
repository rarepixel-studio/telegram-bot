<?php

namespace Telegram\Bot\Objects;

/**
 * Class VideoChatScheduled.
 *
 * Represents a service message about a video chat scheduled in the chat.
 */
class VideoChatScheduled extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Point in time (Unix timestamp) when the video chat is supposed to start.
     */
    public function getStartDate(): int
    {
        return $this->items['start_date'];
    }
}
