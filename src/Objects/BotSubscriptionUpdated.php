<?php

namespace Telegram\Bot\Objects;

/**
 * Class BotSubscriptionUpdated.
 *
 * This object represents a change in a user payment subscription.
 *
 * @link https://core.telegram.org/bots/api#botsubscriptionupdated
 */
class BotSubscriptionUpdated extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}
