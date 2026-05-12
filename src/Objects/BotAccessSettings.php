<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class BotAccessSettings.
 *
 * This object describes the access settings of a managed bot.
 */
class BotAccessSettings extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'added_users' => User::class,
        ];
    }

    /**
     * True, if only selected users can access the bot. The bot's owner can always access it.
     */
    public function getIsAccessRestricted(): bool
    {
        return $this->items['is_access_restricted'];
    }

    /**
     * (Optional). The list of other users who have access to the bot if the access is restricted.
     *
     * @return Collection<int, User>|null
     */
    public function getAddedUsers(): ?Collection
    {
        return $this->items['added_users'] ?? null;
    }
}
