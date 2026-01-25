<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class InputChecklist.
 *
 * Describes a checklist to create.
 */
class InputChecklist extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'title_entities' => MessageEntity::class,
            'tasks' => InputChecklistTask::class,
        ];
    }

    /**
     * Title of the checklist; 1-255 characters after entities parsing.
     */
    public function getTitle(): string
    {
        return $this->items['title'];
    }

    /**
     * (Optional). Mode for parsing entities in the title.
     */
    public function getParseMode(): ?string
    {
        return $this->items['parse_mode'] ?? null;
    }

    /**
     * (Optional). List of special entities that appear in the title.
     *
     * @return Collection<int, MessageEntity>
     */
    public function getTitleEntities(): Collection
    {
        return $this->items['title_entities'];
    }

    /**
     * List of 1-30 tasks in the checklist.
     *
     * @return Collection<int, InputChecklistTask>
     */
    public function getTasks(): Collection
    {
        return $this->items['tasks'];
    }

    /**
     * (Optional). Pass True if other users can add tasks to the checklist.
     */
    public function getOthersCanAddTasks(): ?bool
    {
        return $this->items['others_can_add_tasks'] ?? null;
    }

    /**
     * (Optional). Pass True if other users can mark tasks as done or not done.
     */
    public function getOthersCanMarkTasksAsDone(): ?bool
    {
        return $this->items['others_can_mark_tasks_as_done'] ?? null;
    }

    /**
     * Validate the checklist structure.
     *
     * @throws \Telegram\Bot\Exceptions\TelegramValidationException
     */
    public function validate(): void
    {
        $title = $this->items['title'] ?? '';
        $titleLength = mb_strlen($title);

        if ($titleLength < 1 || $titleLength > 255) {
            throw new \Telegram\Bot\Exceptions\TelegramValidationException(
                'Checklist title must be between 1 and 255 characters'
            );
        }

        $tasks = $this->items['tasks'] ?? [];
        $tasksArray = $tasks instanceof Collection ? $tasks->all() : $tasks;
        $taskCount = count($tasksArray);

        if ($taskCount < 1 || $taskCount > 30) {
            throw new \Telegram\Bot\Exceptions\TelegramValidationException(
                'Checklist must have between 1 and 30 tasks'
            );
        }
    }
}
