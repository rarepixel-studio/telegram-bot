<?php

namespace Telegram\Bot\Objects;

/**
 * Class ReactionCount.
 *
 * Represents a reaction added to a message along with the number of times it was added.
 */
class ReactionCount extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'type' => ReactionType::class,
        ];
    }

    /**
     * Type of the reaction.
     */
    public function getType(): ReactionType
    {
        return $this->items['type'];
    }

    /**
     * Number of times the reaction was added.
     */
    public function getTotalCount(): int
    {
        return $this->items['total_count'];
    }
}
