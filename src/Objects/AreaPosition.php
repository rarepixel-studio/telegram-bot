<?php

namespace Telegram\Bot\Objects;

/**
 * The position of an area on story media or a TON wallet card.
 *
 * @link https://core.telegram.org/bots/api#areaposition
 */
class AreaPosition extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * The abscissa of the area's center, as a percentage of the media or the card width.
     */
    public function getXPercentage(): float
    {
        return $this->items['x_percentage'];
    }

    /**
     * The ordinate of the area's center, as a percentage of the media or the card height.
     */
    public function getYPercentage(): float
    {
        return $this->items['y_percentage'];
    }

    /**
     * The width of the area's rectangle, as a percentage of the media or the card width.
     */
    public function getWidthPercentage(): float
    {
        return $this->items['width_percentage'];
    }

    /**
     * The height of the area's rectangle, as a percentage of the media or the card height.
     */
    public function getHeightPercentage(): float
    {
        return $this->items['height_percentage'];
    }

    /**
     * The clockwise rotation angle of the rectangle, in degrees.
     */
    public function getRotationAngle(): float
    {
        return $this->items['rotation_angle'];
    }

    /**
     * The radius of the rectangle corner rounding, as a percentage of the media or the card width.
     */
    public function getCornerRadiusPercentage(): float
    {
        return $this->items['corner_radius_percentage'];
    }
}
