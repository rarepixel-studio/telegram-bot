<?php

namespace Telegram\Bot\Objects;

/**
 * Class MessageOriginChannel.
 *
 * The message was originally sent to a channel chat.
 */
class MessageOriginChannel extends MessageOrigin
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
     * Channel chat to which the message was originally sent.
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
     * (Optional). Signature of the original post author.
     */
    public function getAuthorSignature(): ?string
    {
        return $this->items['author_signature'] ?? null;
    }
}
