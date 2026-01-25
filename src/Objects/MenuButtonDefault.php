<?php

namespace Telegram\Bot\Objects;

/**
 * Class MenuButtonDefault.
 *
 * Represents a menu button, which opens the bot's list of commands.
 */
class MenuButtonDefault extends MenuButton
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}
