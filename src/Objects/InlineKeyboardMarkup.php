<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;
use Telegram\Bot\Contracts\ClientConstructibleObjectInterface;
use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Class InlineKeyboardMarkup.
 *
 * This object represents an inline keyboard that appears right next to the message it belongs to.
 */
class InlineKeyboardMarkup extends BaseObject implements ClientConstructibleObjectInterface
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'inline_keyboard' => InlineKeyboardButton::class,
        ];
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
     * Create an InlineKeyboardMarkup instance.
     *
     * @param  array<string, mixed>|array<int, array<int, InlineKeyboardButton|array<string, mixed>>>  $items
     * @param  mixed  ...$args
     */
    public static function make($items = [], ...$args): self
    {
        if (is_array($items) && array_key_exists('inline_keyboard', $items)) {
            return new self($items);
        }

        if (is_array($items)) {
            return new self(['inline_keyboard' => $items]);
        }

        return new self([]);
    }

    /**
     * Set the inline keyboard rows.
     *
     * @param  array<int, array<int, InlineKeyboardButton|array<string, mixed>>>  $rows
     */
    public function withInlineKeyboard(array $rows): self
    {
        $this->items['inline_keyboard'] = $rows;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function validate(): void
    {
        if (! isset($this->items['inline_keyboard'])) {
            throw new TelegramValidationException('inline_keyboard is required');
        }

        $rows = $this->items['inline_keyboard'];
        $rows = $rows instanceof Collection ? $rows->all() : $rows;

        if (! is_array($rows) || $rows === []) {
            throw new TelegramValidationException('inline_keyboard must be a non-empty array');
        }

        foreach ($rows as $row) {
            $rowItems = $row instanceof Collection ? $row->all() : $row;
            if (! is_array($rowItems) || $rowItems === []) {
                throw new TelegramValidationException('inline_keyboard rows must be non-empty arrays');
            }

            foreach ($rowItems as $button) {
                if ($button instanceof InlineKeyboardButton) {
                    $button->validate();

                    continue;
                }

                if (is_array($button)) {
                    InlineKeyboardButton::fromArray($button)->validate();

                    continue;
                }

                throw new TelegramValidationException('inline_keyboard must contain InlineKeyboardButton items');
            }
        }
    }

    /**
     * Array of button rows.
     *
     * @return array<int, array<int, InlineKeyboardButton>>|null
     */
    public function getInlineKeyboard(): ?array
    {
        $inlineKeyboard = $this->items['inline_keyboard'] ?? null;

        if ($inlineKeyboard instanceof Collection) {
            return $inlineKeyboard->all();
        }

        return $inlineKeyboard;
    }
}
