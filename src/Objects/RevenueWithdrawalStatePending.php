<?php

namespace Telegram\Bot\Objects;

/**
 * Class RevenueWithdrawalStatePending.
 *
 * The withdrawal is continuously being processed.
 *
 * @link https://core.telegram.org/bots/api#revenuewithdrawalstatepending
 */
class RevenueWithdrawalStatePending extends RevenueWithdrawalState
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}
