<?php

namespace Telegram\Bot\Objects;

/**
 * A backdrop for a chat share theme.
 *
 * @link https://core.telegram.org/bots/api#chatsharethemebackdrop
 */
class ChatShareThemeBackdrop extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'colors' => UniqueGiftBackdropColors::class,
        ];
    }

    /**
     * The unique identifier.
     */
    public function getId(): int
    {
        return $this->items['id'];
    }

    /**
     * Name of the backdrop.
     */
    public function getName(): string
    {
        return $this->items['name'];
    }

    /**
     * The colors used by the backdrop.
     */
    public function getColors(): UniqueGiftBackdropColors
    {
        return $this->items['colors'];
    }
}
