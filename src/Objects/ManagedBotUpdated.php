<?php

namespace Telegram\Bot\Objects;

/**
 * Class ManagedBotUpdated.
 *
 * This object represents an update about a managed bot.
 */
class ManagedBotUpdated extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'user' => User::class,
            'bot_user' => User::class,
        ];
    }

    /**
     * User who created or updated the managed bot.
     */
    public function getUser(): User
    {
        return $this->items['user'];
    }

    /**
     * The bot user.
     */
    public function getBotUser(): User
    {
        return $this->items['bot_user'];
    }
}
