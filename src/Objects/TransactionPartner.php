<?php

namespace Telegram\Bot\Objects;

/**
 * Class TransactionPartner.
 *
 * Describes the source of a transaction, or its recipient for outgoing transactions.
 * 
 * @link https://core.telegram.org/bots/api#transactionpartner
 */
abstract class TransactionPartner extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Type of the transaction partner.
     */
    public function getType(): string
    {
        return $this->items['type'];
    }
}
