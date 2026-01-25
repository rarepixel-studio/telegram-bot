<?php

namespace Telegram\Bot\Objects;

/**
 * Class BotShortDescription.
 *
 * This object represents the bot's short description.
 */
class BotShortDescription extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * The bot's short description.
     */
    public function getShortDescription(): string
    {
        return $this->items['short_description'];
    }
}
