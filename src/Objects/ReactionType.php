<?php

namespace Telegram\Bot\Objects;

/**
 * Class ReactionType.
 *
 * This object describes the type of a reaction.
 */
class ReactionType extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Type of the reaction.
     */
    public function getType(): string
    {
        return $this->items['type'];
    }
}
