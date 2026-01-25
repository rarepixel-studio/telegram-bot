<?php

namespace Telegram\Bot\Objects;

/**
 * Class RevenueWithdrawalStateSucceeded.
 *
 * The withdrawal succeeded.
 *
 * @link https://core.telegram.org/bots/api#revenuewithdrawalstatesucceeded
 */
class RevenueWithdrawalStateSucceeded extends RevenueWithdrawalState
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Date the withdrawal was completed in Unix time.
     */
    public function getDate(): int
    {
        return $this->items['date'];
    }

    /**
     * An HTTPS URL that can be used to see transaction details.
     */
    public function getUrl(): string
    {
        return $this->items['url'];
    }
}
