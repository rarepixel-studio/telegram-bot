<?php

namespace Telegram\Bot\Objects\InputContent;

use Telegram\Bot\Objects\InlineQuery\InlineBaseObject;

/**
 * Class InputContactMessageContent.
 *
 * Represents the content of a contact message to be sent as the result of an inline query.
 *
 * @link https://core.telegram.org/bots/api#inputcontactmessagecontent
 */
class InputContactMessageContent extends InlineBaseObject
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
     * (Optional). Additional data about the contact in the form of a vCard.
     */
    public function getVcard(): ?string
    {
        return $this->items['vcard'] ?? null;
    }
}
