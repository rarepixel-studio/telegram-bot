<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class StarTransactions.
 *
 * Contains a list of Telegram Star transactions.
 */
class StarTransactions extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'transactions' => StarTransaction::class,
        ];
    }

    /**
     * The list of transactions.
     */
    /**
     * @return Collection<int, StarTransaction>
     */
    public function getTransactions(): Collection
    {
        return $this->items['transactions'];
    }
}
