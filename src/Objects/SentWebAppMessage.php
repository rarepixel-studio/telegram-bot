<?php

namespace Telegram\Bot\Objects;

/**
 * Class SentWebAppMessage.
 *
 * Describes an inline message sent by a Web App on behalf of a user.
 */
class SentWebAppMessage extends BaseObject
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
