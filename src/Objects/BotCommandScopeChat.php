<?php

namespace Telegram\Bot\Objects;

/**
 * Class BotCommandScopeChat.
 *
 * Represents the scope of bot commands, covering a specific chat.
 */
class BotCommandScopeChat extends BotCommandScope
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Unique identifier for the target chat.
     */
    public function getChatId(): string
    {
        return $this->items['chat_id'];
    }
}
