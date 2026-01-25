<?php

namespace Telegram\Bot\Objects;

/**
 * Class PaidMediaPurchased.
 *
 * This object contains information about a paid media purchase.
 *
 * @link https://core.telegram.org/bots/api#paidmediapurchased
 */
class PaidMediaPurchased extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'from' => User::class,
        ];
    }

    /**
     * User who purchased the media.
     */
    public function getFrom(): User
    {
        return $this->items['from'];
    }

    /**
     * Bot-specified payload for the paid media transaction.
     */
    public function getPaidMediaPayload(): string
    {
        return $this->items['paid_media_payload'];
    }
}
