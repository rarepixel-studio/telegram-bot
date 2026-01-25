<?php

namespace Telegram\Bot\Objects;

/**
 * Class MenuButton.
 *
 * This object describes the bot's menu button in a private chat.
 */
class MenuButton extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Type of the button.
     */
    public function getType(): string
    {
        return $this->items['type'];
    }
}
