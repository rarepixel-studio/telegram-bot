<?php

namespace Telegram\Bot\Objects;

/**
 * Class Contact. *
 */
class Contact extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Contact's phone number.
     */
    public function getPhoneNumber(): string
    {
        return $this->items['phone_number'];
    }

    /**
     * Contact's first name.
     */
    public function getFirstName(): string
    {
        return $this->items['first_name'];
    }

    /**
     * (Optional). Contact's last name.
     */
    public function getLastName(): ?string
    {
        return $this->items['last_name'] ?? null;
    }

    /**
     * (Optional). Contact's user identifier in Telegram.
     */
    public function getUserId(): ?int
    {
        return $this->items['user_id'] ?? null;
    }

    /**
     * (Optional). Additional data about the contact in the form of a vCard.
     */
    public function getVcard(): ?string
    {
        return $this->items['vcard'] ?? null;
    }
}
