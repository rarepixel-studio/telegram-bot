<?php

namespace Telegram\Bot\Objects;

/**
 * A service message indicating that a sender used a link waiving Telegram Stars.
 *
 * @link https://core.telegram.org/bots/api#paidmessageswaived
 */
class PaidMessagesWaived extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}
