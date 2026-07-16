<?php

namespace Telegram\Bot\Objects;

/**
 * Class CommunityChatAdded.
 *
 * This object represents a service message about a chat being added to a community.
 *
 * @link https://core.telegram.org/bots/api#communitychatadded
 */
class CommunityChatAdded extends BaseObject
{
    /**
     * Community to which the chat was added.
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
