<?php

namespace Telegram\Bot\Objects;

/**
 * Class SuggestedPostDeclined.
 *
 * Describes a service message about the rejection of a suggested post.
 */
class SuggestedPostDeclined extends BaseObject
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
     * (Optional). Comment with which the post was declined.
     */
    public function getComment(): ?string
    {
        return $this->items['comment'] ?? null;
    }
}
