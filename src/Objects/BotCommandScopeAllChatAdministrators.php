<?php

namespace Telegram\Bot\Objects;

/**
 * Class BotCommandScopeAllChatAdministrators.
 *
 * Represents the scope of bot commands, covering all group and supergroup chat administrators.
 */
class BotCommandScopeAllChatAdministrators extends BotCommandScope
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}
