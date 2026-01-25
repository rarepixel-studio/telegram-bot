<?php

namespace Telegram\Bot\Objects;

/**
 * Class RefundedPayment.
 *
 * Contains basic information about a refunded payment.
 */
class RefundedPayment extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Three-letter ISO 4217 currency code, or "XTR" for payments in Telegram Stars.
     */
    public function getCurrency(): string
    {
        return $this->items['currency'];
    }

    /**
     * Total refunded price in the smallest units of the currency.
     */
    public function getTotalAmount(): int
    {
        return $this->items['total_amount'];
    }

    /**
     * Bot-specified invoice payload.
     */
    public function getInvoicePayload(): string
    {
        return $this->items['invoice_payload'];
    }

    /**
     * Telegram payment identifier.
     */
    public function getTelegramPaymentChargeId(): string
    {
        return $this->items['telegram_payment_charge_id'];
    }

    /**
     * (Optional). Provider payment identifier.
     */
    public function getProviderPaymentChargeId(): ?string
    {
        return $this->items['provider_payment_charge_id'] ?? null;
    }
}
