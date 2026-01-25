<?php

namespace Telegram\Bot\Objects;

/**
 * Class BackgroundFillSolid.
 *
 * The background is filled with a single color.
 *
 * @link https://core.telegram.org/bots/api#backgroundfillsolid
 */
class BackgroundFillSolid extends BackgroundFill
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * The color of the background fill in the RGB24 format.
     */
    public function getColor(): int
    {
        return $this->items['color'];
    }
}
