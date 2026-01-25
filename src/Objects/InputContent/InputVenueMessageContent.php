<?php

namespace Telegram\Bot\Objects\InputContent;

use Telegram\Bot\Objects\InlineQuery\InlineBaseObject;

/**
 * Class InputVenueMessageContent.
 *
 * Represents the content of a venue message to be sent as the result of an inline query.
 *
 * @link https://core.telegram.org/bots/api#inputvenuemessagecontent
 */
class InputVenueMessageContent extends InlineBaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Latitude of the venue location in degrees.
     */
    public function getLatitude(): float
    {
        return $this->items['latitude'];
    }

    /**
     * Longitude of the venue location in degrees.
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
     * (Optional). Foursquare type of the venue.
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
