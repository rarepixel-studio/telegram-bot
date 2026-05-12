<?php

namespace Telegram\Bot\Objects;

/**
 * Class InputMediaVenue.
 *
 * Represents a venue to be sent.
 */
class InputMediaVenue extends InputMedia
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Type of the result, must be venue.
     */
    public function getType(): string
    {
        return 'venue';
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
     * (Optional). Foursquare type of the venue, if known.
     */
    public function getFoursquareType(): ?string
    {
        return $this->items['foursquare_type'] ?? null;
    }

    /**
     * (Optional). Google Places identifier of the venue.
     */
    public function getGooglePlaceId(): ?string
    {
        return $this->items['google_place_id'] ?? null;
    }

    /**
     * (Optional). Google Places type of the venue.
     */
    public function getGooglePlaceType(): ?string
    {
        return $this->items['google_place_type'] ?? null;
    }
}
