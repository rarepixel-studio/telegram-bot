<?php

namespace Telegram\Bot\Objects;

/**
 * A chat share theme based on a unique gift.
 *
 * @link https://core.telegram.org/bots/api#chatsharethemeuniquegift
 */
class ChatShareThemeUniqueGift extends ChatShareTheme
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'gift' => UniqueGift::class,
        ];
    }

    /**
     * The associated unique gift.
     */
    public function getGift(): UniqueGift
    {
        return $this->items['gift'];
    }
}
