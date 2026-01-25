<?php

namespace Telegram\Bot\Objects;

/**
 * Class SuggestedPostApprovalFailed.
 *
 * Describes a service message about the failed approval of a suggested post.
 */
class SuggestedPostApprovalFailed extends BaseObject
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
     * (Optional). Message containing the suggested post whose approval failed.
     */
    public function getSuggestedPostMessage(): ?Message
    {
        return $this->items['suggested_post_message'] ?? null;
    }

    /**
     * Expected price of the post.
     */
    public function getPrice(): SuggestedPostPrice
    {
        return $this->items['price'];
    }
}
