<?php

namespace Telegram\Bot\Objects;

/**
 * Class ChatBoostRemoved.
 *
 * This object represents a boost removed from a chat.
 *
 * @link https://core.telegram.org/bots/api#chatboostremoved
 */
class ChatBoostRemoved extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'chat' => Chat::class,
            'source' => ChatBoostSource::class,
        ];
    }

    /**
     * Chat which was boosted.
     */
    public function getChat(): Chat
    {
        return $this->items['chat'];
    }

    /**
     * Unique identifier of the boost.
     */
    public function getBoostId(): string
    {
        return $this->items['boost_id'];
    }

    /**
     * Point in time (Unix timestamp) when the boost was removed.
     */
    public function getRemoveDate(): int
    {
        return $this->items['remove_date'];
    }

    /**
     * Source of the removed boost.
     */
    public function getSource(): ChatBoostSource
    {
        return $this->items['source'];
    }
}
