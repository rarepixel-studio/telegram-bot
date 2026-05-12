<?php

namespace Telegram\Bot\Objects;

/**
 * Class PaidMediaPreview.
 *
 * The paid media isn't available before the payment.
 */
class PaidMediaPreview extends PaidMedia
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Type of the paid media, always "preview".
     */
    public function getType(): string
    {
        return $this->items['type'];
    }

    /**
     * (Optional). Media width as defined by the sender.
     */
    public function getWidth(): ?int
    {
        return $this->items['width'] ?? null;
    }

    /**
     * (Optional). Media height as defined by the sender.
     */
    public function getHeight(): ?int
    {
        return $this->items['height'] ?? null;
    }

    /**
     * (Optional). Duration of the media in seconds as defined by the sender.
     */
    public function getDuration(): ?int
    {
        return $this->items['duration'] ?? null;
    }
}
