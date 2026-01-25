<?php

namespace Telegram\Bot\Objects;

/**
 * Class BackgroundFillFreeformGradient.
 *
 * The background is a freeform gradient that rotates after every message in the chat.
 *
 * @link https://core.telegram.org/bots/api#backgroundfillfreeformgradient
 */
class BackgroundFillFreeformGradient extends BackgroundFill
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * A list of the 3 or 4 base colors that are used to generate the freeform gradient in the RGB24 format.
     *
     * @return int[]
     */
    public function getColors(): array
    {
        return $this->items['colors'];
    }
}
