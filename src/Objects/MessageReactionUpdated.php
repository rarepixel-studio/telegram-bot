<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class MessageReactionUpdated.
 *
 * Represents a change of a reaction on a message performed by a user.
 */
class MessageReactionUpdated extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'chat' => Chat::class,
            'user' => User::class,
            'actor_chat' => Chat::class,
            'old_reaction' => ReactionType::class,
            'new_reaction' => ReactionType::class,
        ];
    }

    /**
     * The chat containing the message the user reacted to.
     */
    public function getChat(): Chat
    {
        return $this->items['chat'];
    }

    /**
     * Unique identifier of the message inside the chat.
     */
    public function getMessageId(): int
    {
        return $this->items['message_id'];
    }

    /**
     * (Optional). The user that changed the reaction, if the user isn't anonymous.
     */
    public function getUser(): ?User
    {
        return $this->items['user'] ?? null;
    }

    /**
     * (Optional). The chat on behalf of which the reaction was changed, if the user is anonymous.
     */
    public function getActorChat(): ?Chat
    {
        return $this->items['actor_chat'] ?? null;
    }

    /**
     * Date of the change in Unix time.
     */
    public function getDate(): int
    {
        return $this->items['date'];
    }

    /**
     * Previous list of reaction types that were set by the user.
     */
    /**
     * @return Collection<int, ReactionType>
     */
    public function getOldReaction(): Collection
    {
        return $this->items['old_reaction'];
    }

    /**
     * New list of reaction types that have been set by the user.
     */
    /**
     * @return Collection<int, ReactionType>
     */
    public function getNewReaction(): Collection
    {
        return $this->items['new_reaction'];
    }
}
