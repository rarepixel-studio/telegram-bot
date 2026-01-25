<?php

namespace Telegram\Bot\Objects;

/**
 * Class ChecklistTasksDone.
 *
 * Describes a service message about checklist tasks marked as done or not done.
 */
class ChecklistTasksDone extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'checklist_message' => Message::class,
        ];
    }

    /**
     * (Optional). Message containing the checklist whose tasks were marked.
     */
    public function getChecklistMessage(): ?Message
    {
        return $this->items['checklist_message'] ?? null;
    }

    /**
     * (Optional). Identifiers of the tasks that were marked as done.
     */
    public function getMarkedAsDoneTaskIds(): ?array
    {
        return $this->items['marked_as_done_task_ids'] ?? null;
    }

    /**
     * (Optional). Identifiers of the tasks that were marked as not done.
     */
    public function getMarkedAsNotDoneTaskIds(): ?array
    {
        return $this->items['marked_as_not_done_task_ids'] ?? null;
    }
}
