<?php

namespace Telegram\Bot\Objects;

/**
 * Class AffiliateInfo.
 *
 * Contains information about the affiliate that received a commission via this transaction.
 *
 * @link https://core.telegram.org/bots/api#affiliateinfo
 */
class AffiliateInfo extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'affiliate_user' => User::class,
            'affiliate_chat' => Chat::class,
        ];
    }

    /**
     * (Optional). The bot or the user that received an affiliate commission if it was received by a bot or a user.
     */
    public function getAffiliateUser(): ?User
    {
        return $this->items['affiliate_user'] ?? null;
    }

    /**
     * (Optional). The chat that received an affiliate commission if it was received by a chat.
     */
    public function getAffiliateChat(): ?Chat
    {
        return $this->items['affiliate_chat'] ?? null;
    }

    /**
     * The number of Telegram Stars received by the affiliate for each 1000 Telegram Stars received by the bot from referred users.
     */
    public function getCommissionPerMille(): int
    {
        return $this->items['commission_per_mille'];
    }

    /**
     * Integer amount of Telegram Stars received by the affiliate from the transaction.
     */
    public function getAmount(): int
    {
        return $this->items['amount'];
    }

    /**
     * (Optional). The number of 1/1000000000 shares of Telegram Stars received by the affiliate.
     */
    public function getNanostarAmount(): ?int
    {
        return $this->items['nanostar_amount'] ?? null;
    }
}
