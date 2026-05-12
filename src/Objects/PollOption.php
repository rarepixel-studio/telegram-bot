<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class PollOption.
 *
 * Represents one answer option in a poll.
 */
class PollOption extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'added_by_chat' => Chat::class,
            'added_by_user' => User::class,
            'text_entities' => MessageEntity::class,
            'media' => PollMedia::class,
        ];
    }

    /**
     * Option text, 1-100 characters.
     */
    public function getText(): string
    {
        return $this->items['text'];
    }

    /**
     * Number of users that voted for this option.
     */
    public function getVoterCount(): int
    {
        return $this->items['voter_count'];
    }

    /**
     * @return Collection<int, MessageEntity>|null
     */
    public function getTextEntities(): ?Collection
    {
        return $this->items['text_entities'] ?? null;
    }

    /**
     * Unique identifier for the poll option.
     */
    public function getPersistentId(): string
    {
        return $this->items['persistent_id'];
    }

    /**
     * (Optional). Media added to the poll option.
     */
    public function getMedia(): ?PollMedia
    {
        return $this->items['media'] ?? null;
    }

    /**
     * (Optional). User who added the option.
     */
    public function getAddedByUser(): ?User
    {
        return $this->items['added_by_user'] ?? null;
    }

    /**
     * (Optional). Chat that added the option.
     */
    public function getAddedByChat(): ?Chat
    {
        return $this->items['added_by_chat'] ?? null;
    }

    /**
     * (Optional). Point in time when the option was added.
     */
    public function getAdditionDate(): ?int
    {
        return $this->items['addition_date'] ?? null;
    }
}
