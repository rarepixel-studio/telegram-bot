<?php

namespace Telegram\Bot\Objects;

/**
 * Class ProximityAlertTriggered.
 *
 * Represents a service message sent when a user triggers a proximity alert.
 */
class ProximityAlertTriggered extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'traveler' => User::class,
            'watcher' => User::class,
        ];
    }

    /**
     * User that triggered the alert.
     */
    public function getTraveler(): User
    {
        return $this->items['traveler'];
    }

    /**
     * User that set the alert.
     */
    public function getWatcher(): User
    {
        return $this->items['watcher'];
    }

    /**
     * The distance between the users.
     */
    public function getDistance(): int
    {
        return $this->items['distance'];
    }
}
