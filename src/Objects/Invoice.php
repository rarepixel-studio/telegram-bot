<?php

namespace Telegram\Bot\Objects;

/**
 * Class Invoice.
 */
class Invoice extends BaseObject
{
    /**
     * Property relations.
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Product name.
     */
    public function getTitle(): string
    {
        return $this->items['title'];
    }

    /**
     * Product description.
     */
    public function getDescription(): string
    {
        return $this->items['description'];
    }

    /**
     * Unique bot deep-linking parameter that can be used to generate this invoice.
     */
    public function getStartParameter(): string
    {
        return $this->items['start_parameter'];
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
}
