<?php

namespace Telegram\Bot\Objects;

/**
 * Class SuggestedPostPaid.
 *
 * Describes a service message about a successful payment for a suggested post.
 */
class SuggestedPostPaid extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'suggested_post_message' => Message::class,
            'star_amount' => StarAmount::class,
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
     * Currency in which the payment was made.
     */
    public function getCurrency(): string
    {
        return $this->items['currency'];
    }

    /**
     * (Optional). Amount received in nanotoncoins; for toncoin payments only.
     */
    public function getAmount(): ?int
    {
        return $this->items['amount'] ?? null;
    }

    /**
     * (Optional). Amount of Telegram Stars received by the channel.
     */
    public function getStarAmount(): ?StarAmount
    {
        return $this->items['star_amount'] ?? null;
    }
}
