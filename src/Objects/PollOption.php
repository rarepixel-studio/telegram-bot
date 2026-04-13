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
            'text_entities' => MessageEntity::class,
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
}
