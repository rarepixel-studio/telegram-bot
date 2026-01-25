<?php

namespace Telegram\Bot\Objects;

use Telegram\Bot\Contracts\ClientConstructibleObjectInterface;

/**
 * Class CallbackGame.
 * A placeholder, currently holds no information. Use BotFather to set up your game.
 */
class CallbackGame extends BaseObject implements ClientConstructibleObjectInterface
{
    /**
     * Property relations.
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Create a new instance from array data.
     *
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): static
    {
        return new static($data);
    }

    /**
     * Create a new CallbackGame instance.
     *
     * @param  array<string, mixed>  $items
     */
    public static function make($items = []): self
    {
        if (is_array($items)) {
            return new self($items);
        }

        return new self([]);
    }

    /**
     * {@inheritDoc}
     */
    public function validate(): void
    {
        // No validation rules defined for CallbackGame.
    }
}
