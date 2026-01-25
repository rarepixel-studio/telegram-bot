<?php

namespace Telegram\Bot\Objects;

/**
 * Class TransactionPartnerOther.
 *
 * Describes a transaction with an unknown source or recipient.
 *
 * @link https://core.telegram.org/bots/api#transactionpartnerother
 */
class TransactionPartnerOther extends TransactionPartner
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}
