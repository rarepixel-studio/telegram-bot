<?php

namespace Telegram\Bot\Objects;

/**
 * Class ChatBoostUpdated.
 *
 * This object represents a boost added to a chat or changed.
 *
 * @link https://core.telegram.org/bots/api#chatboostupdated
 */
class ChatBoostUpdated extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'chat' => Chat::class,
            'boost' => ChatBoost::class,
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
     * Information about the chat boost.
     */
    public function getBoost(): ChatBoost
    {
        return $this->items['boost'];
    }
}
