<?php

namespace Telegram\Bot\Objects;

/**
 * Class TransactionPartnerAffiliateProgram.
 *
 * Describes the affiliate program that issued the affiliate commission received via this transaction.
 *
 * @link https://core.telegram.org/bots/api#transactionpartneraffiliateprogram
 */
class TransactionPartnerAffiliateProgram extends TransactionPartner
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'sponsor_user' => User::class,
        ];
    }

    /**
     * (Optional). Information about the bot that sponsored the affiliate program.
     */
    public function getSponsorUser(): ?User
    {
        return $this->items['sponsor_user'] ?? null;
    }

    /**
     * The number of Telegram Stars received by the bot for each 1000 Telegram Stars received by the affiliate program sponsor from referred users.
     */
    public function getCommissionPerMille(): int
    {
        return $this->items['commission_per_mille'];
    }
}
