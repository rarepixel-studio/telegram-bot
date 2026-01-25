<?php

namespace Telegram\Bot\Objects;

/**
 * Class MessageAutoDeleteTimerChanged.
 *
 * Represents a service message about a change in auto-delete timer settings.
 */
class MessageAutoDeleteTimerChanged extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * New auto-delete time for messages in the chat; in seconds.
     */
    public function getMessageAutoDeleteTime(): int
    {
        return $this->items['message_auto_delete_time'];
    }
}
