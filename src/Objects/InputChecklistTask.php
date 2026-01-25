<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class InputChecklistTask.
 *
 * Describes a task to add to a checklist.
 */
class InputChecklistTask extends BaseObject
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
     * Unique identifier of the task.
     */
    public function getId(): int
    {
        return $this->items['id'];
    }

    /**
     * Text of the task; 1-100 characters after entities parsing.
     */
    public function getText(): string
    {
        return $this->items['text'];
    }

    /**
     * (Optional). Mode for parsing entities in the text.
     */
    public function getParseMode(): ?string
    {
        return $this->items['parse_mode'] ?? null;
    }

    /**
     * @return Collection<int, MessageEntity>|null
     */
    public function getTextEntities(): ?Collection
    {
        return $this->items['text_entities'] ?? null;
    }
}
