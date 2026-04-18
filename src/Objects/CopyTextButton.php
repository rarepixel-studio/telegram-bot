<?php

namespace Telegram\Bot\Objects;

use Telegram\Bot\Contracts\ClientConstructibleObjectInterface;
use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Class CopyTextButton.
 *
 * Represents a button that copies specified text to the clipboard.
 */
class CopyTextButton extends BaseObject implements ClientConstructibleObjectInterface
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
     * Create a CopyTextButton instance.
     *
     * @param  array<string, mixed>|string  $items
     * @param  mixed  ...$args
     */
    public static function make($items = [], ...$args): self
    {
        if (is_string($items)) {
            return new self(['text' => $items]);
        }

        if (is_array($items)) {
            return new self($items);
        }

        return new self([]);
    }

    /**
     * Set the text to copy.
     */
    public function withText(string $text): self
    {
        $this->items['text'] = $text;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function validate(): void
    {
        if (! isset($this->items['text'])) {
            throw new TelegramValidationException('text is required');
        }

        $length = mb_strlen($this->items['text']);
        if ($length < 1 || $length > 256) {
            throw new TelegramValidationException('text must be 1-256 characters');
        }
    }

    /**
     * Text to be copied to the clipboard.
     */
    public function getText(): string
    {
        return $this->items['text'];
    }
}
