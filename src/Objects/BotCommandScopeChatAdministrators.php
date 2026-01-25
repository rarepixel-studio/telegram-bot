<?php

namespace Telegram\Bot\Objects;

/**
 * Class BotCommandScopeChatAdministrators.
 *
 * Represents the scope of bot commands, covering all administrators of a specific group or supergroup chat.
 */
class BotCommandScopeChatAdministrators extends BotCommandScope
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
