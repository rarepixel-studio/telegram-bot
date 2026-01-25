<?php

namespace Telegram\Bot\Objects;

/**
 * Class ForumTopic.
 *
 * Represents a forum topic.
 */
class ForumTopic extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Unique identifier of the forum topic.
     */
    public function getMessageThreadId(): int
    {
        return $this->items['message_thread_id'];
    }

    /**
     * Name of the topic.
     */
    public function getName(): string
    {
        return $this->items['name'];
    }

    /**
     * Color of the topic icon in RGB format.
     */
    public function getIconColor(): int
    {
        return $this->items['icon_color'];
    }

    /**
     * (Optional). Unique identifier of the custom emoji shown as the topic icon.
     */
    public function getIconCustomEmojiId(): ?string
    {
        return $this->items['icon_custom_emoji_id'] ?? null;
    }
}
