<?php

namespace Telegram\Bot\Objects;

/**
 * Class CommunityChatRemoved.
 *
 * This object represents a service message about a chat being removed from a community.
 *
 * @link https://core.telegram.org/bots/api#communitychatremoved
 */
class CommunityChatRemoved extends BaseObject
{
    /**
     * Community from which the chat was removed.
     */
    public function getCommunity(): Community
    {
        return new Community($this->items['community']);
    }

    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'community' => Community::class,
        ];
    }
}
