<?php

namespace Telegram\Bot\Objects;

/**
 * Class BusinessMessagesDeleted.
 *
 * This object is received when messages are deleted from a connected business account.
 */
class BusinessMessagesDeleted extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'chat' => Chat::class,
        ];
    }

    /**
     * Unique identifier of the business connection.
     */
    public function getBusinessConnectionId(): string
    {
        return $this->items['business_connection_id'];
    }

    /**
     * Information about a chat in the business account.
     */
    public function getChat(): Chat
    {
        return $this->items['chat'];
    }

    /**
     * The list of identifiers of deleted messages in the chat of the business account.
     */
    public function getMessageIds(): array
    {
        return $this->items['message_ids'];
    }
}
