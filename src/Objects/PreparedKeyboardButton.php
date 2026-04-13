<?php

namespace Telegram\Bot\Objects;

/**
 * Class PreparedKeyboardButton.
 *
 * Represents a prepared keyboard button that was saved.
 */
class PreparedKeyboardButton extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Unique identifier of the prepared keyboard button.
     */
    public function getId(): string
    {
        return $this->items['id'];
    }
}
