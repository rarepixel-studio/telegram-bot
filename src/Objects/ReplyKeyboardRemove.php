<?php

namespace Telegram\Bot\Objects;

use Telegram\Bot\Contracts\ClientConstructibleObjectInterface;
use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Class ReplyKeyboardRemove.
 *
 * Requests clients to remove the custom keyboard.
 */
class ReplyKeyboardRemove extends BaseObject implements ClientConstructibleObjectInterface
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
     * Create a ReplyKeyboardRemove instance.
     *
     * @param  array<string, mixed>|bool  $items
     * @param  mixed  ...$args
     */
    public static function make($items = [], ...$args): self
    {
        if (is_bool($items)) {
            return new self(['remove_keyboard' => $items]);
        }

        if (is_array($items)) {
            return new self($items);
        }

        return new self(['remove_keyboard' => true]);
    }

    /**
     * Set whether the keyboard should be removed.
     */
    public function withRemoveKeyboard(bool $removeKeyboard): self
    {
        $this->items['remove_keyboard'] = $removeKeyboard;

        return $this;
    }

    /**
     * Set whether the removal is selective.
     */
    public function withSelective(?bool $selective): self
    {
        $this->items['selective'] = $selective;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function validate(): void
    {
        if (($this->items['remove_keyboard'] ?? null) !== true) {
            throw new TelegramValidationException('remove_keyboard must be true');
        }
    }

    /**
     * Requests clients to remove the custom keyboard.
     */
    public function getRemoveKeyboard(): bool
    {
        return $this->items['remove_keyboard'];
    }

    /**
     * True if removal is selective.
     */
    public function getSelective(): ?bool
    {
        return $this->items['selective'] ?? null;
    }
}
