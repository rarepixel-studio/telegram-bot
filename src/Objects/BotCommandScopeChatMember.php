<?php

namespace Telegram\Bot\Objects;

/**
 * Class BotCommandScopeChatMember.
 *
 * Represents the scope of bot commands, covering a specific member of a group or supergroup chat.
 */
class BotCommandScopeChatMember extends BotCommandScope
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

    /**
     * Unique identifier of the target user.
     */
    public function getUserId(): int
    {
        return $this->items['user_id'];
    }
}
