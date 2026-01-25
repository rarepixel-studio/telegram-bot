<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class VideoChatParticipantsInvited.
 *
 * Represents a service message about new members invited to a video chat.
 */
class VideoChatParticipantsInvited extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'users' => User::class,
        ];
    }

    /**
     * New members that were invited to the video chat.
     *
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->items['users'];
    }
}
