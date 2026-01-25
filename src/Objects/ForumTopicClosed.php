<?php

namespace Telegram\Bot\Objects;

/**
 * Class ForumTopicClosed.
 *
 * Represents a service message about a forum topic closed in the chat.
 * Currently holds no information.
 */
class ForumTopicClosed extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}
