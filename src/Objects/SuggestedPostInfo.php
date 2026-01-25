<?php

namespace Telegram\Bot\Objects;

/**
 * Class SuggestedPostInfo.
 *
 * Contains information about a suggested post.
 */
class SuggestedPostInfo extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'price' => SuggestedPostPrice::class,
        ];
    }

    /**
     * State of the suggested post.
     */
    public function getState(): string
    {
        return $this->items['state'];
    }

    /**
     * (Optional). Proposed price of the post.
     */
    public function getPrice(): ?SuggestedPostPrice
    {
        return $this->items['price'] ?? null;
    }

    /**
     * (Optional). Proposed send date of the post.
     */
    public function getSendDate(): ?int
    {
        return $this->items['send_date'] ?? null;
    }
}
