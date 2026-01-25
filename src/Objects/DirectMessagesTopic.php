<?php

namespace Telegram\Bot\Objects;

/**
 * Class DirectMessagesTopic.
 *
 * Describes a topic of a direct messages chat.
 */
class DirectMessagesTopic extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'user' => User::class,
        ];
    }

    /**
     * Unique identifier of the topic.
     */
    public function getTopicId(): int
    {
        return $this->items['topic_id'];
    }

    /**
     * (Optional). Information about the user that created the topic.
     */
    public function getUser(): ?User
    {
        return $this->items['user'] ?? null;
    }
}
