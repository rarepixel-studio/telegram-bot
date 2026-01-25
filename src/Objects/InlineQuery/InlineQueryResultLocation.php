<?php

namespace Telegram\Bot\Objects\InlineQuery;

/**
 * Class InlineQueryResultLocation.
 *
 * Represents a location on a map.
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultlocation
 */
class InlineQueryResultLocation extends InlineQueryResult
{
    public function __construct($params = [])
    {
        parent::__construct($params);
        $this->put('type', 'location');
    }

    /**
     * Location latitude in degrees.
     */
    public function getLatitude(): float
    {
        return $this->items['latitude'];
    }

    /**
     * Location longitude in degrees.
     */
    public function getLongitude(): float
    {
        return $this->items['longitude'];
    }

    /**
     * Location title.
     */
    public function getTitle(): string
    {
        return $this->items['title'];
    }

    /**
     * (Optional). The radius of uncertainty for the location, measured in meters.
     */
    public function getHorizontalAccuracy(): ?float
    {
        return $this->items['horizontal_accuracy'] ?? null;
    }

    /**
     * (Optional). Period in seconds for which the location can be updated.
     */
    public function getLivePeriod(): ?int
    {
        return $this->items['live_period'] ?? null;
    }

    /**
     * (Optional). The direction in which user is moving, in degrees.
     */
    public function getHeading(): ?int
    {
        return $this->items['heading'] ?? null;
    }

    /**
     * (Optional). The maximum distance in meters for proximity alerts.
     */
    public function getProximityAlertRadius(): ?int
    {
        return $this->items['proximity_alert_radius'] ?? null;
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
