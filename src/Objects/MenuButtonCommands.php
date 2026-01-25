<?php

namespace Telegram\Bot\Objects;

/**
 * Class MenuButtonCommands.
 *
 * Represents a menu button, which opens the bot's list of commands.
 */
class MenuButtonCommands extends MenuButton
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}
