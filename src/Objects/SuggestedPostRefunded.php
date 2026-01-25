<?php

namespace Telegram\Bot\Objects;

/**
 * Class SuggestedPostRefunded.
 *
 * Describes a service message about a payment refund for a suggested post.
 */
class SuggestedPostRefunded extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'suggested_post_message' => Message::class,
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
     * Reason for the refund.
     */
    public function getReason(): string
    {
        return $this->items['reason'];
    }
}
