<?php

namespace Telegram\Bot\Objects;

/**
 * Class ForumTopicEdited.
 *
 * Represents a service message about an edited forum topic.
 */
class ForumTopicEdited extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * (Optional). New name of the topic, if it was edited.
     */
    public function getName(): ?string
    {
        return $this->items['name'] ?? null;
    }

    /**
     * (Optional). New identifier of the custom emoji shown as the topic icon, if it was edited; an empty string if the icon was removed.
     */
    public function getIconCustomEmojiId(): ?string
    {
        return $this->items['icon_custom_emoji_id'] ?? null;
    }
}
