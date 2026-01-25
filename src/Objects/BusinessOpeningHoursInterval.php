<?php

namespace Telegram\Bot\Objects;

/**
 * Class BusinessOpeningHoursInterval.
 *
 * Describes an interval of time during which a business is open.
 */
class BusinessOpeningHoursInterval extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * The minute's sequence number in a week, starting on Monday.
     */
    public function getOpeningMinute(): int
    {
        return $this->items['opening_minute'];
    }

    /**
     * The minute's sequence number in a week, starting on Monday.
     */
    public function getClosingMinute(): int
    {
        return $this->items['closing_minute'];
    }
}
