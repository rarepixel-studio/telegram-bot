<?php

namespace Telegram\Bot\Objects;

/**
 * Class StarTransaction.
 *
 * Describes a Telegram Star transaction.
 */
class StarTransaction extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'source' => TransactionPartner::class,
            'receiver' => TransactionPartner::class,
        ];
    }

    /**
     * Unique identifier of the transaction.
     */
    public function getId(): string
    {
        return $this->items['id'];
    }

    /**
     * Integer amount of Telegram Stars transferred by the transaction.
     */
    public function getAmount(): int
    {
        return $this->items['amount'];
    }

    /**
     * (Optional). The number of 1/1000000000 shares of Telegram Stars transferred.
     */
    public function getNanostarAmount(): ?int
    {
        return $this->items['nanostar_amount'] ?? null;
    }

    /**
     * Date the transaction was created in Unix time.
     */
    public function getDate(): int
    {
        return $this->items['date'];
    }

    /**
     * (Optional). Source of an incoming transaction (TransactionPartner).
     */
    public function getSource(): ?TransactionPartner
    {
        return $this->items['source'] ?? null;
    }

    /**
     * (Optional). Receiver of an outgoing transaction (TransactionPartner).
     */
    public function getReceiver(): ?TransactionPartner
    {
        return $this->items['receiver'] ?? null;
    }
}
