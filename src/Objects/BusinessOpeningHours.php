<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class BusinessOpeningHours.
 *
 * Describes the opening hours of a business.
 */
class BusinessOpeningHours extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'opening_hours' => BusinessOpeningHoursInterval::class,
        ];
    }

    /**
     * Unique name of the time zone for which the opening hours are defined.
     */
    public function getTimeZoneName(): string
    {
        return $this->items['time_zone_name'];
    }

    /**
     * List of time intervals describing business opening hours.
     */
    /**
     * @return Collection<int, BusinessOpeningHoursInterval>
     */
    public function getOpeningHours(): Collection
    {
        return $this->items['opening_hours'];
    }
}
