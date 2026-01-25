<?php

namespace Telegram\Bot\Objects;

/**
 * Class BackgroundType.
 *
 * This object describes the type of a background.
 *
 * @link https://core.telegram.org/bots/api#backgroundtype
 */
abstract class BackgroundType extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Type of the background.
     */
    public function getType(): string
    {
        return $this->items['type'];
    }
}
