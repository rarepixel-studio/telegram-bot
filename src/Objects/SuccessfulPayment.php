<?php

namespace Telegram\Bot\Objects;

/**
 * Class SuccessfulPayment.
 */
class SuccessfulPayment extends BaseObject
{
    /**
     * Property relations.
     */
    public function relations(): array
    {
        return [
            'order_info' => OrderInfo::class,
        ];
    }

    /**
     * Three-letter ISO 4217 currency code.
     */
    public function getCurrency(): string
    {
        return $this->items['currency'];
    }

    /**
     * Total price in the smallest units of the currency (integer, not float/double). For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies)..
     */
    public function getTotalAmount(): int
    {
        return $this->items['total_amount'];
    }

    /**
     * Bot specified invoice payload.
     */
    public function getInvoicePayload(): string
    {
        return $this->items['invoice_payload'];
    }

    /**
     * Optional. Identifier of the shipping option chosen by the user.
     */
    public function getShippingOptionId(): string
    {
        return $this->items['shipping_option_id'];
    }

    /**
     * Optional. Order info provided by the user.
     */
    public function getOrderInfo(): OrderInfo
    {
        return $this->items['order_info'];
    }

    /**
     * Telegram payment identifier.
     */
    public function getTelegramPaymentChargeId(): string
    {
        return $this->items['telegram_payment_charge_id'];
    }

    /**
     * Provider payment identifier.
     */
    public function getProviderPaymentChargeId(): string
    {
        return $this->items['provider_payment_charge_id'];
    }
}
