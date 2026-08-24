<?php

namespace Telegram\Bot\Objects;

/**
 * Class MessageGenerationStopped.
 *
 * This object describes an update about a user stopping message generation.
 *
 * @link https://core.telegram.org/bots/api#messagegenerationstopped
 */
class MessageGenerationStopped extends BaseObject
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
     * Chat in which the message is generated.
     */
    public function getChat(): Chat
    {
        return $this->items['chat'];
    }

    /**
     * (Optional). Unique identifier of the message thread in which the message is generated.
     */
    public function getMessageThreadId(): ?int
    {
        return $this->items['message_thread_id'] ?? null;
    }

    /**
     * Unique identifier of the message draft which was stopped.
     */
    public function getDraftId(): int
    {
        return $this->items['draft_id'];
    }
}
