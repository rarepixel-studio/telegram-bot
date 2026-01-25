<?php

namespace Telegram\Bot\Objects;

/**
 * Class ChatBackground.
 *
 * This object represents a chat background.
 *
 * @link https://core.telegram.org/bots/api#chatbackground
 */
class ChatBackground extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'type' => BackgroundType::class,
        ];
    }

    /**
     * Type of the background.
     */
    public function getType(): BackgroundType
    {
        return $this->items['type'];
    }
}
