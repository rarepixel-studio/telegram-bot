<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class Checklist.
 *
 * Describes a checklist.
 */
class Checklist extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'title_entities' => MessageEntity::class,
            'tasks' => ChecklistTask::class,
        ];
    }

    /**
     * Title of the checklist.
     */
    public function getTitle(): string
    {
        return $this->items['title'];
    }

    /**
     * (Optional). Special entities that appear in the checklist title.
     *
     * @return Collection<int, MessageEntity>
     */
    public function getTitleEntities(): Collection
    {
        return $this->items['title_entities'];
    }

    /**
     * List of tasks in the checklist.
     *
     * @return Collection<int, ChecklistTask>
     */
    public function getTasks(): Collection
    {
        return $this->items['tasks'];
    }

    /**
     * (Optional). True, if users other than the creator can add tasks to the list.
     */
    public function getOthersCanAddTasks(): ?bool
    {
        return $this->items['others_can_add_tasks'] ?? null;
    }

    /**
     * (Optional). True, if users other than the creator can mark tasks as done or not done.
     */
    public function getOthersCanMarkTasksAsDone(): ?bool
    {
        return $this->items['others_can_mark_tasks_as_done'] ?? null;
    }
}
