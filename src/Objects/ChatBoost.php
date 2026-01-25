<?php

namespace Telegram\Bot\Objects;

/**
 * Class ChatBoost.
 *
 * This object contains information about a chat boost.
 *
 * @link https://core.telegram.org/bots/api#chatboost
 */
class ChatBoost extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'source' => ChatBoostSource::class,
        ];
    }

    /**
     * Unique identifier of the boost.
     */
    public function getBoostId(): string
    {
        return $this->items['boost_id'];
    }

    /**
     * Point in time (Unix timestamp) when the chat was boosted.
     */
    public function getAddDate(): int
    {
        return $this->items['add_date'];
    }

    /**
     * Point in time (Unix timestamp) when the boost will automatically expire, unless the booster's Telegram Premium subscription is prolonged.
     */
    public function getExpirationDate(): int
    {
        return $this->items['expiration_date'];
    }

    /**
     * Source of the added boost.
     */
    public function getSource(): ChatBoostSource
    {
        return $this->items['source'];
    }
}
