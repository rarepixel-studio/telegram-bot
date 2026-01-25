<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class MessageReactionCountUpdated.
 *
 * Represents reaction changes on a message with anonymous reactions.
 */
class MessageReactionCountUpdated extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'chat' => Chat::class,
            'reactions' => ReactionCount::class,
        ];
    }

    /**
     * The chat containing the message.
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
     * Date of the change in Unix time.
     */
    public function getDate(): int
    {
        return $this->items['date'];
    }

    /**
     * List of reactions that are present on the message.
     */
    /**
     * @return Collection<int, ReactionCount>
     */
    public function getReactions(): Collection
    {
        return $this->items['reactions'];
    }
}
