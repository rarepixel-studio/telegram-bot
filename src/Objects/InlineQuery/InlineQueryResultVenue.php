<?php

namespace Telegram\Bot\Objects\InlineQuery;

/**
 * Class InlineQueryResultVenue.
 *
 * Represents a venue.
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultvenue
 */
class InlineQueryResultVenue extends InlineQueryResult
{
    public function __construct($params = [])
    {
        parent::__construct($params);
        $this->put('type', 'venue');
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

    /**
     * (Optional). URL of the thumbnail for the result.
     */
    public function getThumbUrl(): ?string
    {
        return $this->items['thumb_url'] ?? null;
    }

    /**
     * (Optional). Thumbnail width.
     */
    public function getThumbWidth(): ?int
    {
        return $this->items['thumb_width'] ?? null;
    }

    /**
     * (Optional). Thumbnail height.
     */
    public function getThumbHeight(): ?int
    {
        return $this->items['thumb_height'] ?? null;
    }
}
