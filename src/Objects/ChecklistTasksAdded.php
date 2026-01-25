<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class ChecklistTasksAdded.
 *
 * Describes a service message about tasks added to a checklist.
 */
class ChecklistTasksAdded extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'checklist_message' => Message::class,
            'tasks' => ChecklistTask::class,
        ];
    }

    /**
     * (Optional). Message containing the checklist to which the tasks were added.
     */
    public function getChecklistMessage(): ?Message
    {
        return $this->items['checklist_message'] ?? null;
    }

    /**
     * List of tasks added to the checklist.
     */
    /**
     * @return Collection<int, ChecklistTask>
     */
    public function getTasks(): Collection
    {
        return $this->items['tasks'];
    }
}
