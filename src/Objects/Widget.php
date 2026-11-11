<?php

namespace Telegram\Bot\Objects;

/**
 * An HTML widget attached to a message.
 *
 * @link https://core.telegram.org/bots/api#widget
 */
class Widget extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * The unique identifier.
     */
    public function getId(): ?string
    {
        return $this->items['id'] ?? null;
    }

    /**
     * Width of the widget in logical pixels.
     */
    public function getWidth(): ?int
    {
        return $this->items['width'] ?? null;
    }

    /**
     * Height of the widget in logical pixels.
     */
    public function getHeight(): ?int
    {
        return $this->items['height'] ?? null;
    }

    /**
     * The HTML code of the widget.
     */
    public function getHtml(): string
    {
        return $this->items['html'];
    }

    /**
     * Data shared across all messages displaying this widget.
     */
    public function getPublicData(): ?string
    {
        return $this->items['public_data'] ?? null;
    }

    /**
     * Data specific to the message containing the widget.
     */
    public function getChatData(): ?string
    {
        return $this->items['chat_data'] ?? null;
    }
}
