<?php

namespace Telegram\Bot\Objects;

/**
 * Class Venue. *
 *                                    “arts_entertainment/default”, “arts_entertainment/aquarium” or
 *                                    “food/icecream”.)
 */
class Venue extends BaseObject
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
     * Venue location.
     */
    public function getLocation(): Location
    {
        return $this->items['location'];
    }

    /**
     * Name of the venue.
     */
    public function getTitle(): string
    {
        return $this->items['title'];
    }

    /**
     * Address of the venue.
     */
    public function getAddress(): string
    {
        return $this->items['address'];
    }

    /**
     * (Optional). Foursquare identifier of the venue.
     */
    public function getFoursquareId(): ?string
    {
        return $this->items['foursquare_id'] ?? null;
    }

    /**
     * (Optional). Foursquare type of the venue. (For example,
     */
    public function getFoursquareType(): ?string
    {
        return $this->items['foursquare_type'] ?? null;
    }
}
