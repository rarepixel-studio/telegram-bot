<?php

namespace Telegram\Bot\Objects;

use Telegram\Bot\Contracts\ClientConstructibleObjectInterface;

/**
 * Class DisabledButton.
 *
 * This object represents a disabled button which does nothing. Currently holds no information.
 *
 * @link https://core.telegram.org/bots/api#disabledbutton
 */
class DisabledButton extends BaseObject implements ClientConstructibleObjectInterface
{
    /**
     * {@inheritdoc}
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
     * Create a DisabledButton instance.
     *
     * @param  array<string, mixed>  $items
     * @param  mixed  ...$args
     */
    public static function make($items = [], ...$args): self
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
        // No validation rules defined for DisabledButton.
    }
}
