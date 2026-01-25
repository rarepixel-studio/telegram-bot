<?php

namespace Telegram\Bot\Objects;

/**
 * Class ShippingQuery. *
 */
class ShippingQuery extends BaseObject
{
    /**
     * Property relations.
     */
    public function relations(): array
    {
        return [
            'shipping_address' => ShippingAddress::class,
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
     * Bot specified invoice payload.
     */
    public function getInvoicePayload(): string
    {
        return $this->items['invoice_payload'];
    }

    /**
     * User specified shipping address.
     */
    public function getShippingAddress(): ShippingAddress
    {
        return $this->items['shipping_address'];
    }
}
