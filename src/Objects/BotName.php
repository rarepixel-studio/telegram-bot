<?php

namespace Telegram\Bot\Objects;

/**
 * Class BotName.
 *
 * This object represents the bot's name.
 */
class BotName extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * The bot's name.
     */
    public function getName(): string
    {
        return $this->items['name'];
    }
}
