<?php

namespace Telegram\Bot\Objects;

/**
 * Class ManagedBotCreated.
 *
 * This object represents a service message about a new managed bot created by a user.
 */
class ManagedBotCreated extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'bot' => User::class,
        ];
    }

    /**
     * Information about the created bot.
     */
    public function getBot(): User
    {
        return $this->items['bot'];
    }
}
