<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class SharedUser.
 *
 * Contains information about a user that was shared with the bot.
 */
class SharedUser extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'photo' => PhotoSize::class,
        ];
    }

    /**
     * Identifier of the shared user.
     */
    public function getUserId(): int
    {
        return $this->items['user_id'];
    }

    /**
     * (Optional). First name of the user.
     */
    public function getFirstName(): ?string
    {
        return $this->items['first_name'] ?? null;
    }

    /**
     * (Optional). Last name of the user.
     */
    public function getLastName(): ?string
    {
        return $this->items['last_name'] ?? null;
    }

    /**
     * (Optional). Username of the user.
     */
    public function getUsername(): ?string
    {
        return $this->items['username'] ?? null;
    }

    /**
     * (Optional). Available sizes of the chat photo.
     *
     * @return Collection<int, PhotoSize>|null
     */
    public function getPhoto(): ?Collection
    {
        return $this->items['photo'] ?? null;
    }
}
