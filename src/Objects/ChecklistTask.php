<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class ChecklistTask.
 *
 * Describes a task in a checklist.
 */
class ChecklistTask extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'text_entities' => MessageEntity::class,
            'completed_by_user' => User::class,
        ];
    }

    /**
     * Unique identifier of the task.
     */
    public function getId(): int
    {
        return $this->items['id'];
    }

    /**
     * Text of the task.
     */
    public function getText(): string
    {
        return $this->items['text'];
    }

    /**
     * (Optional). Special entities that appear in the task text.
     *
     * @return Collection<int, MessageEntity>
     */
    public function getTextEntities(): Collection
    {
        return $this->items['text_entities'];
    }

    /**
     * (Optional). User that completed the task; omitted if the task wasn't completed.
     */
    public function getCompletedByUser(): ?User
    {
        return $this->items['completed_by_user'] ?? null;
    }

    /**
     * (Optional). Point in time (Unix timestamp) when the task was completed; 0 if the task wasn't completed.
     */
    public function getCompletionDate(): ?int
    {
        return $this->items['completion_date'] ?? null;
    }
}
