<?php

namespace Telegram\Bot\Objects;

/**
 * Class TransactionPartnerTelegramApi.
 *
 * Describes a transaction with payment for paid broadcasting.
 *
 * @link https://core.telegram.org/bots/api#transactionpartnertelegramapi
 */
class TransactionPartnerTelegramApi extends TransactionPartner
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * The number of successful requests that exceeded regular limits and were therefore billed.
     */
    public function getRequestCount(): int
    {
        return $this->items['request_count'];
    }
}
