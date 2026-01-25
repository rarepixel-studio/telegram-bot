<?php

namespace Telegram\Bot\Objects\InlineQuery;

/**
 * Class InlineQueryResultContact.
 *
 * Represents a contact with a phone number.
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultcontact
 */
class InlineQueryResultContact extends InlineQueryResult
{
    public function __construct($params = [])
    {
        parent::__construct($params);
        $this->put('type', 'contact');
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

    /**
     * (Optional). URL of the thumbnail for the result.
     */
    public function getThumbUrl(): ?string
    {
        return $this->items['thumb_url'] ?? null;
    }

    /**
     * (Optional). Thumbnail width.
     */
    public function getThumbWidth(): ?int
    {
        return $this->items['thumb_width'] ?? null;
    }

    /**
     * (Optional). Thumbnail height.
     */
    public function getThumbHeight(): ?int
    {
        return $this->items['thumb_height'] ?? null;
    }
}
