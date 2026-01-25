<?php

namespace Telegram\Bot\Objects;

/**
 * Class MessageOrigin.
 *
 * This object describes the origin of a message.
 */
class MessageOrigin extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Type of the message origin.
     */
    public function getType(): string
    {
        return $this->items['type'];
    }

    /**
     * Date the message was sent originally in Unix time.
     */
    public function getDate(): int
    {
        return $this->items['date'];
    }
}
