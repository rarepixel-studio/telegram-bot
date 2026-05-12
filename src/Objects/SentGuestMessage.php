<?php

namespace Telegram\Bot\Objects;

/**
 * Class SentGuestMessage.
 *
 * Contains information about a sent guest message.
 */
class SentGuestMessage extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Identifier of the sent inline message.
     */
    public function getInlineMessageId(): string
    {
        return $this->items['inline_message_id'];
    }
}
