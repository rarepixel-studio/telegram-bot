<?php

namespace Telegram\Bot\Objects;

/**
 * Class RichBlockCaption.
 *
 * Represents the caption of a rich formatted text.
 *
 * @link https://core.telegram.org/bots/api#richblockcaption
 */
class RichBlockCaption extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'text' => RichText::class,
            'credit' => RichText::class,
        ];
    }

    /**
     * Text of the caption.
     */
    public function getText(): mixed
    {
        return $this->items['text'] ?? null;
    }

    /**
     * (Optional). Credit for the media.
     */
    public function getCredit(): mixed
    {
        return $this->items['credit'] ?? null;
    }
}
