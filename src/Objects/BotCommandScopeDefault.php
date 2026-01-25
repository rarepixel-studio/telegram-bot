<?php

namespace Telegram\Bot\Objects;

/**
 * Class BotCommandScopeDefault.
 *
 * Represents the default scope of bot commands.
 */
class BotCommandScopeDefault extends BotCommandScope
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}
