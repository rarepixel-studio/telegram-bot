<?php

namespace Telegram\Bot\Objects;

/**
 * Class OrderInfo.
 */
class OrderInfo extends BaseObject
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
     * (Optional). User name.
     */
    public function getName(): ?string
    {
        return $this->items['name'] ?? null;
    }

    /**
     * (Optional). User's phone number.
     */
    public function getPhoneNumber(): ?string
    {
        return $this->items['phone_number'] ?? null;
    }

    /**
     * (Optional). User email.
     */
    public function getEmail(): ?string
    {
        return $this->items['email'] ?? null;
    }

    /**
     * (Optional). User shipping address.
     */
    public function getShippingAddress(): ?ShippingAddress
    {
        return $this->items['shipping_address'] ?? null;
    }
}
