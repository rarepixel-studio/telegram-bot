<?php

namespace Telegram\Bot\Objects;

/**
 * Class CommunityChatJoined.
 *
 * Describes a service message about a chat being joined by a user from a community.
 *
 * @link https://core.telegram.org/bots/api#communitychatjoined
 */
class CommunityChatJoined extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'community' => Community::class,
        ];
    }

    /**
     * The community from which the chat was joined.
     */
    public function getCommunity(): Community
    {
        return $this->items['community'];
    }
}
