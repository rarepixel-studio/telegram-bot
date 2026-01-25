<?php

namespace Telegram\Bot\Objects;

/**
 * Class MaskPosition.
 */
class MaskPosition extends BaseObject
{
    /**
     * Property relations.
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * The part of the face relative to which the mask should be placed. One of "forehead", "eyes", "mouth", or "chin".
     */
    public function getPoint(): string
    {
        return $this->items['point'];
    }

    /**
     * Shift by X-axis measured in widths of the mask scaled to the face size, from left to right. For example, choosing -1.0 will place mask just to the left of the default mask position.
     */
    public function getXShift(): float
    {
        return $this->items['x_shift'];
    }

    /**
     * Shift by Y-axis measured in heights of the mask scaled to the face size, from top to bottom. For example, 1.0 will place the mask just below the default mask position.
     */
    public function getYShift(): float
    {
        return $this->items['y_shift'];
    }

    /**
     * Mask scaling coefficient. For example, 2.0 means double size.
     */
    public function getZoom(): float
    {
        return $this->items['zoom'];
    }
}
