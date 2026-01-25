<?php

namespace Telegram\Bot\Objects;

/**
 * Class Story.
 *
 * This object represents a story.
 *
 * @link https://core.telegram.org/bots/api#story
 */
class Story extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'chat' => Chat::class,
        ];
    }

    /**
     * Unique identifier for the story in the chat.
     */
    public function getId(): int
    {
        return $this->items['id'];
    }

    /**
     * Chat that posted the story.
     */
    public function getChat(): Chat
    {
        return $this->items['chat'];
    }
}
