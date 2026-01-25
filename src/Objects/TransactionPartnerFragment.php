<?php

namespace Telegram\Bot\Objects;

/**
 * Class TransactionPartnerFragment.
 *
 * Describes a withdrawal transaction with Fragment.
 *
 * @link https://core.telegram.org/bots/api#transactionpartnerfragment
 */
class TransactionPartnerFragment extends TransactionPartner
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'withdrawal_state' => RevenueWithdrawalState::class,
        ];
    }

    /**
     * (Optional). State of the transaction if the transaction is outgoing.
     */
    public function getWithdrawalState(): ?RevenueWithdrawalState
    {
        return $this->items['withdrawal_state'] ?? null;
    }
}
