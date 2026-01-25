<?php

namespace Telegram\Bot\Objects;

/**
 * Class InaccessibleMessage.
 *
 * Describes a message that was deleted or is otherwise inaccessible to the bot.
 */
class InaccessibleMessage extends BaseObject
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
     * Chat the message belonged to.
     */
    public function getChat(): Chat
    {
        return $this->items['chat'];
    }

    /**
     * Unique message identifier inside the chat.
     */
    public function getMessageId(): int
    {
        return $this->items['message_id'];
    }

    /**
     * Always 0.
     */
    public function getDate(): int
    {
        return $this->items['date'];
    }
}
