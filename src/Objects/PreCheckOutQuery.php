<?php

namespace Telegram\Bot\Objects;

/**
 * Class PreCheckOutQuery.
 */
class PreCheckOutQuery extends BaseObject
{
    /**
     * Property relations.
     */
    public function relations(): array
    {
        return [
            'from' => User::class,
            'order_info' => OrderInfo::class,
        ];
    }

    /**
     * Unique query identifier.
     */
    public function getId(): string
    {
        return $this->items['id'];
    }

    /**
     * User who sent the query.
     */
    public function getFrom(): User
    {
        return $this->items['from'];
    }

    /**
     * Three-letter ISO 4217 currency code.
     */
    public function getCurrency(): string
    {
        return $this->items['currency'];
    }

    /**
     * Total price in the smallest units of the currency (integer, not float/double). For example, for a price of US$ 1.45 pass amount = 145. See the exp parameter in currencies.json, it shows the number of digits past the decimal point for each currency (2 for the majority of currencies).
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
     * (Optional). Identifier of the shipping option chosen by the user.
     */
    public function getShippingOptionId(): ?string
    {
        return $this->items['shipping_option_id'] ?? null;
    }

    /**
     * (Optional). Order info provided by the user.
     */
    public function getOrderInfo(): ?OrderInfo
    {
        return $this->items['order_info'] ?? null;
    }
}
