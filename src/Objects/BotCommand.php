<?php

namespace Telegram\Bot\Objects;

/**
 * Class BotCommand.
 *
 * This object represents a bot command.
 */
class BotCommand extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Text of the command, 1-32 characters.
     */
    public function getCommand(): string
    {
        return $this->items['command'];
    }

    /**
     * Description of the command, 1-256 characters.
     */
    public function getDescription(): string
    {
        return $this->items['description'];
    }

    /**
     * (Optional). True if the command is ephemeral.
     */
    public function getIsEphemeral(): ?bool
    {
        return $this->items['is_ephemeral'] ?? null;
    }
}
