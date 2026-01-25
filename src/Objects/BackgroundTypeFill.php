<?php

namespace Telegram\Bot\Objects;

/**
 * Class BackgroundTypeFill.
 *
 * The background is automatically filled based on the selected colors.
 *
 * @link https://core.telegram.org/bots/api#backgroundtypefill
 */
class BackgroundTypeFill extends BackgroundType
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'fill' => BackgroundFill::class,
        ];
    }

    /**
     * The background fill.
     */
    public function getFill(): BackgroundFill
    {
        return $this->items['fill'];
    }

    /**
     * Dimming of the background in dark themes, as a percentage; 0-100.
     */
    public function getDarkThemeDimming(): int
    {
        return $this->items['dark_theme_dimming'];
    }
}
