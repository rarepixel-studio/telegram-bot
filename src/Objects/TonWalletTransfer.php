<?php

namespace Telegram\Bot\Objects;

/**
 * A service message about a TON wallet transfer.
 *
 * @link https://core.telegram.org/bots/api#tonwallettransfer
 */
class TonWalletTransfer extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Unique identifier of the transaction.
     */
    public function getTransactionId(): string
    {
        return $this->items['transaction_id'];
    }

    /**
     * Address of the transfer peer in the TON blockchain.
     */
    public function getPeerAddress(): string
    {
        return $this->items['peer_address'];
    }

    /**
     * A decimal string in the smallest units of the currency.
     */
    public function getAmount(): string
    {
        return $this->items['amount'];
    }

    /**
     * Comment added to the transfer.
     */
    public function getComment(): ?string
    {
        return $this->items['comment'] ?? null;
    }
}
