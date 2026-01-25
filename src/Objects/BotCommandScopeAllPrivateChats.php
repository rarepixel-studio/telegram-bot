<?php

namespace Telegram\Bot\Objects;

/**
 * Class BotCommandScopeAllPrivateChats.
 *
 * Represents the scope of bot commands, covering all private chats.
 */
class BotCommandScopeAllPrivateChats extends BotCommandScope
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}
