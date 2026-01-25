<?php

namespace Telegram\Bot\Objects;

/**
 * Describes an inline message to be sent by a user of a Mini App.
 *
 * @link https://core.telegram.org/bots/api#preparedinlinemessage
 */
class PreparedInlineMessage extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Unique identifier of the prepared message.
     */
    public function getId(): string
    {
        return $this->items['id'];
    }

    /**
     * The point in time (Unix timestamp) when the prepared message will expire.
     */
    public function getExpirationDate(): int
    {
        return $this->items['expiration_date'];
    }
}
