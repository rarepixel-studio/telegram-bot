<?php

namespace Telegram\Bot\Objects;

/**
 * Class ShippingAddress.
 */
class ShippingAddress extends BaseObject
{
    /**
     * Property relations.
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * ISO 3166-1 alpha-2 country code.
     */
    public function getCountryCode(): string
    {
        return $this->items['country_code'];
    }

    /**
     * State, if applicable.
     */
    public function getState(): string
    {
        return $this->items['state'];
    }

    /**
     * City.
     */
    public function getCity(): string
    {
        return $this->items['city'];
    }

    /**
     * First line for the address.
     */
    public function getStreetLine1(): string
    {
        return $this->items['street_line1'];
    }

    /**
     * Second line for the address.
     */
    public function getStreetLine2(): string
    {
        return $this->items['street_line2'];
    }

    /**
     * Address post code.
     */
    public function getPostCode(): string
    {
        return $this->items['post_code'];
    }
}
