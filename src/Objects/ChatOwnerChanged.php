<?php

namespace Telegram\Bot\Objects;

/**
 * Class ChatOwnerChanged.
 *
 * Represents a service message about the owner of the chat being changed.
 *
 * @link https://core.telegram.org/bots/api#chatownerchanged
 */
class ChatOwnerChanged extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'old_owner' => User::class,
            'new_owner' => User::class,
        ];
    }

    /**
     * The previous owner of the chat.
     */
    public function getOldOwner(): User
    {
        return $this->items['old_owner'];
    }

    /**
     * The new owner of the chat.
     */
    public function getNewOwner(): User
    {
        return $this->items['new_owner'];
    }

    /**
     * Date the ownership was transferred, in Unix time.
     */
    public function getDate(): int
    {
        return $this->items['date'];
    }
}
