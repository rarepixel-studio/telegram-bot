<?php

namespace Telegram\Bot\Objects;

use Telegram\Bot\Contracts\ClientConstructibleObjectInterface;
use Telegram\Bot\Enums\PollType;
use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Class KeyboardButtonPollType.
 *
 * Represents type of a poll which is allowed to be created.
 */
class KeyboardButtonPollType extends BaseObject implements ClientConstructibleObjectInterface
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
     * Create a KeyboardButtonPollType instance.
     *
     * @param  array<string, mixed>|PollType|string|null  $items
     *
     * @throws TelegramValidationException
     */
    public static function make($items = []): self
    {
        if (is_array($items)) {
            return new self($items);
        }

        return (new self([]))->withType($items);
    }

    /**
     * Set the poll type.
     *
     * @throws TelegramValidationException
     */
    public function withType(PollType|string|null $type): self
    {
        if (is_string($type)) {
            try {
                $type = PollType::from($type);
            } catch (\ValueError $exception) {
                throw new TelegramValidationException('Invalid poll type provided', previous: $exception);
            }
        }

        $this->items['type'] = $type;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function validate(): void
    {
        if (isset($this->items['type'])) {
            $type = $this->items['type'];
            if (is_string($type)) {
                try {
                    $type = PollType::from($type);
                } catch (\ValueError $exception) {
                    throw new TelegramValidationException('Invalid poll type provided', previous: $exception);
                }
                $this->items['type'] = $type;
            }
        }
    }

    /**
     * Poll type.
     */
    public function getType(): ?string
    {
        $type = $this->items['type'] ?? null;

        return $type instanceof PollType ? $type->value : $type;
    }
}
