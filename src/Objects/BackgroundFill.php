<?php

namespace Telegram\Bot\Objects;

/**
 * Class BackgroundFill.
 *
 * This object describes the way a background is filled based on the selected colors.
 *
 * @link https://core.telegram.org/bots/api#backgroundfill
 */
abstract class BackgroundFill extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Type of the background fill.
     */
    public function getType(): string
    {
        return $this->items['type'];
    }
}
