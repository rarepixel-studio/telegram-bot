<?php

namespace Telegram\Bot\Objects\InputContent;

use Telegram\Bot\Objects\InlineQuery\InlineBaseObject;

/**
 * Class InputLocationMessageContent.
 *
 * Represents the content of a location message to be sent as the result of an inline query.
 *
 * @link https://core.telegram.org/bots/api#inputlocationmessagecontent
 */
class InputLocationMessageContent extends InlineBaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Latitude of the location in degrees.
     */
    public function getLatitude(): float
    {
        return $this->items['latitude'];
    }

    /**
     * Longitude of the location in degrees.
     */
    public function getLongitude(): float
    {
        return $this->items['longitude'];
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
}
