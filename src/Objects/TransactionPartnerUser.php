<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class TransactionPartnerUser.
 *
 * Describes a transaction with a user.
 *
 * @link https://core.telegram.org/bots/api#transactionpartneruser
 */
class TransactionPartnerUser extends TransactionPartner
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'user' => User::class,
            'affiliate' => AffiliateInfo::class,
            'paid_media' => UnknownObject::class, // PaidMedia is polymorphic
            'gift' => Gift::class,
        ];
    }

    /**
     * Information about the user.
     */
    public function getUser(): User
    {
        return $this->items['user'];
    }

    /**
     * (Optional). Information about the affiliate that received a commission via this transaction.
     */
    public function getAffiliate(): ?AffiliateInfo
    {
        return $this->items['affiliate'] ?? null;
    }

    /**
     * (Optional). Bot-specified invoice payload.
     */
    public function getInvoicePayload(): ?string
    {
        return $this->items['invoice_payload'] ?? null;
    }

    /**
     * (Optional). The duration of the paid subscription.
     */
    public function getSubscriptionPeriod(): ?int
    {
        return $this->items['subscription_period'] ?? null;
    }

    /**
     * (Optional). Information about the paid media bought by the user.
     * 
     * @return Collection<int, UnknownObject>|null
     */
    public function getPaidMedia(): ?Collection
    {
        return $this->items['paid_media'] ?? null;
    }

    /**
     * (Optional). Bot-specified paid media payload.
     */
    public function getPaidMediaPayload(): ?string
    {
        return $this->items['paid_media_payload'] ?? null;
    }

    /**
     * (Optional). The gift sent to the user by the bot.
     */
    public function getGift(): ?Gift
    {
        return $this->items['gift'] ?? null;
    }
}
