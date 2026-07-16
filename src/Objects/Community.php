<?php

namespace Telegram\Bot\Objects;

/**
 * Class Community.
 *
 * Represents a community.
 *
 * @link https://core.telegram.org/bots/api#community
 */
class Community extends BaseObject
{
    /**
     * Unique identifier for this community.
     */
    public function getId(): int
    {
        return $this->items['id'];
    }

    /**
     * Community name.
     */
    public function getName(): string
    {
        return $this->items['name'];
    }

    /**
     * (Optional). Community description.
     */
    public function getDescription(): ?string
    {
        return $this->items['description'] ?? null;
    }

    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}
