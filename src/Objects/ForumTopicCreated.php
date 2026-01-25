<?php

namespace Telegram\Bot\Objects;

/**
 * Class ForumTopicCreated.
 *
 * Represents a service message about a new forum topic created in the chat.
 */
class ForumTopicCreated extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
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
