<?php

namespace Telegram\Bot\Objects;

/**
 * Class SuggestedPostApproved.
 *
 * Describes a service message about the approval of a suggested post.
 */
class SuggestedPostApproved extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'suggested_post_message' => Message::class,
            'price' => SuggestedPostPrice::class,
        ];
    }

    /**
     * (Optional). Message containing the suggested post.
     */
    public function getSuggestedPostMessage(): ?Message
    {
        return $this->items['suggested_post_message'] ?? null;
    }

    /**
     * (Optional). Amount paid for the post.
     */
    public function getPrice(): ?SuggestedPostPrice
    {
        return $this->items['price'] ?? null;
    }

    /**
     * Date when the post will be published.
     */
    public function getSendDate(): int
    {
        return $this->items['send_date'];
    }
}
