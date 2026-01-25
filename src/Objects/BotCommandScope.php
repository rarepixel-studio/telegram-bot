<?php

namespace Telegram\Bot\Objects;

/**
 * Class BotCommandScope.
 *
 * This object represents the scope to which bot commands are applied.
 */
class BotCommandScope extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Scope type.
     */
    public function getType(): string
    {
        return $this->items['type'];
    }
}
