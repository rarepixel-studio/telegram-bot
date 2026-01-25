<?php

namespace Telegram\Bot\Objects;

/**
 * Class BusinessLocation.
 *
 * Contains information about the location of a Telegram Business account.
 */
class BusinessLocation extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'location' => Location::class,
        ];
    }

    /**
     * Location address; 1-96 characters.
     */
    public function getAddress(): string
    {
        return $this->items['address'];
    }

    /**
     * (Optional). The location to which the business is connected.
     */
    public function getLocation(): ?Location
    {
        return $this->items['location'] ?? null;
    }
}
