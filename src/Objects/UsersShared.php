<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class UsersShared.
 *
 * Contains information about the users whose identifiers were shared with the bot.
 */
class UsersShared extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'users' => SharedUser::class,
        ];
    }

    /**
     * Identifier of the request.
     */
    public function getRequestId(): int
    {
        return $this->items['request_id'];
    }

    /**
     * Information about users shared with the bot.
     *
     * @return Collection<int, SharedUser>
     */
    public function getUsers(): Collection
    {
        return $this->items['users'];
    }
}
