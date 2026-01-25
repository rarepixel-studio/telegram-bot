<?php

namespace Telegram\Bot\Objects;

/**
 * Class UniqueGiftBackdropColors.
 *
 * Describes the colors of the backdrop of a unique gift.
 */
class UniqueGiftBackdropColors extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * The color in the center of the backdrop in RGB format.
     */
    public function getCenterColor(): int
    {
        return $this->items['center_color'];
    }

    /**
     * The color on the edges of the backdrop in RGB format.
     */
    public function getEdgeColor(): int
    {
        return $this->items['edge_color'];
    }

    /**
     * The color to be applied to the symbol in RGB format.
     */
    public function getSymbolColor(): int
    {
        return $this->items['symbol_color'];
    }

    /**
     * The color for the text on the backdrop in RGB format.
     */
    public function getTextColor(): int
    {
        return $this->items['text_color'];
    }
}
