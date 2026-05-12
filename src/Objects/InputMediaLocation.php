<?php

namespace Telegram\Bot\Objects;

/**
 * Class InputMediaLocation.
 *
 * Represents a location to be sent.
 */
class InputMediaLocation extends InputMedia
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Type of the result, must be location.
     */
    public function getType(): string
    {
        return 'location';
    }

    /**
     * Latitude of the location.
     */
    public function getLatitude(): float
    {
        return $this->items['latitude'];
    }

    /**
     * Longitude of the location.
     */
    public function getLongitude(): float
    {
        return $this->items['longitude'];
    }

    /**
     * (Optional). The radius of uncertainty for the location, measured in meters; 0-1500.
     */
    public function getHorizontalAccuracy(): ?float
    {
        return $this->items['horizontal_accuracy'] ?? null;
    }
}
