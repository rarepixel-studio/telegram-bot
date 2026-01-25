<?php

namespace Telegram\Bot\Objects;

/**
 * Class BusinessConnection.
 *
 * Describes the connection of the bot with a business account.
 */
class BusinessConnection extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'user' => User::class,
        ];
    }

    /**
     * Unique identifier of the business connection.
     */
    public function getId(): string
    {
        return $this->items['id'];
    }

    /**
     * Business account user that created the business connection.
     */
    public function getUser(): User
    {
        return $this->items['user'];
    }

    /**
     * Identifier of a private chat with the user who created the business connection.
     */
    public function getUserChatId(): int
    {
        return $this->items['user_chat_id'];
    }

    /**
     * Date the connection was established in Unix time.
     */
    public function getDate(): int
    {
        return $this->items['date'];
    }

    /**
     * (Optional). Rights of the business bot (BusinessBotRights).
     */
    public function getRights(): mixed
    {
        return $this->items['rights'];
    }

    /**
     * True, if the connection is active.
     */
    public function getIsEnabled(): bool
    {
        return $this->items['is_enabled'];
    }
}
