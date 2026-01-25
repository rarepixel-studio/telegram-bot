<?php

namespace Telegram\Bot\Objects;

/**
 * Class Location. *
 */
class Location extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Longitude as defined by sender.
     */
    public function getLongitude(): float
    {
        return $this->items['longitude'];
    }

    /**
     * Latitude as defined by sender.
     */
    public function getLatitude(): float
    {
        return $this->items['latitude'];
    }
}
