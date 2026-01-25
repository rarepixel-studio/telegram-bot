<?php

namespace Telegram\Bot\Objects;

/**
 * Class BotCommandScopeAllGroupChats.
 *
 * Represents the scope of bot commands, covering all group and supergroup chats.
 */
class BotCommandScopeAllGroupChats extends BotCommandScope
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}
