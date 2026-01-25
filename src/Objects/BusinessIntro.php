<?php

namespace Telegram\Bot\Objects;

/**
 * Class BusinessIntro.
 *
 * Contains information about the start page settings of a business.
 */
class BusinessIntro extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'sticker' => Sticker::class,
        ];
    }

    /**
     * (Optional). Title text of the business intro.
     */
    public function getTitle(): ?string
    {
        return $this->items['title'] ?? null;
    }

    /**
     * (Optional). Message text of the business intro.
     */
    public function getMessage(): ?string
    {
        return $this->items['message'] ?? null;
    }

    /**
     * (Optional). Sticker of the business intro.
     */
    public function getSticker(): ?Sticker
    {
        return $this->items['sticker'] ?? null;
    }
}
