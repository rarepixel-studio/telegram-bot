<?php

namespace Telegram\Bot\Objects;

/**
 * Class MessageOriginChat.
 *
 * The message was originally sent on behalf of a chat to a group chat.
 */
class MessageOriginChat extends MessageOrigin
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'sender_chat' => Chat::class,
        ];
    }

    /**
     * Chat that sent the message originally.
     */
    public function getSenderChat(): Chat
    {
        return $this->items['sender_chat'];
    }

    /**
     * (Optional). Original message author signature.
     */
    public function getAuthorSignature(): ?string
    {
        return $this->items['author_signature'] ?? null;
    }
}
