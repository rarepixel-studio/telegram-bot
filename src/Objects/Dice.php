<?php

namespace Telegram\Bot\Objects;

/**
 * Class Dice.
 *
 * Represents an animated emoji that displays a random value.
 */
class Dice extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Emoji on which the dice throw animation is based.
     */
    public function getEmoji(): string
    {
        return $this->items['emoji'];
    }

    /**
     * Value of the dice, 1-6 for "🎲", "🎯" and "🎳" base emoji, 1-5 for "🏀" and "⚽" base emoji, 1-64 for "🎰" base emoji.
     */
    public function getValue(): int
    {
        return $this->items['value'];
    }
}
