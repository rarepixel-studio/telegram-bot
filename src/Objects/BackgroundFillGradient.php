<?php

namespace Telegram\Bot\Objects;

/**
 * Class BackgroundFillGradient.
 *
 * The background is a gradient fill.
 *
 * @link https://core.telegram.org/bots/api#backgroundfillgradient
 */
class BackgroundFillGradient extends BackgroundFill
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Top color of the gradient in the RGB24 format.
     */
    public function getTopColor(): int
    {
        return $this->items['top_color'];
    }

    /**
     * Bottom color of the gradient in the RGB24 format.
     */
    public function getBottomColor(): int
    {
        return $this->items['bottom_color'];
    }

    /**
     * Rotation angle of the gradient in degrees; 0-359.
     */
    public function getRotationAngle(): int
    {
        return $this->items['rotation_angle'];
    }
}
