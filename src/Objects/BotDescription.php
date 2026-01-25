<?php

namespace Telegram\Bot\Objects;

/**
 * Class BotDescription.
 *
 * This object represents the bot's description.
 */
class BotDescription extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * The bot's description.
     */
    public function getDescription(): string
    {
        return $this->items['description'];
    }
}
