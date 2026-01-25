<?php

namespace Telegram\Bot\Objects;

/**
 * Class RevenueWithdrawalState.
 *
 * Describes the state of a revenue withdrawal transaction.
 *
 * @link https://core.telegram.org/bots/api#revenuewithdrawalstate
 */
abstract class RevenueWithdrawalState extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Type of the state.
     */
    public function getType(): string
    {
        return $this->items['type'];
    }
}
