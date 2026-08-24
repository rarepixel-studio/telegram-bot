<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;
use Telegram\Bot\Contracts\ClientConstructibleObjectInterface;
use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Class ReplyKeyboardMarkup.
 *
 * This object represents a custom keyboard with reply options.
 */
class ReplyKeyboardMarkup extends BaseObject implements ClientConstructibleObjectInterface
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'keyboard' => KeyboardButton::class,
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
     * Create a ReplyKeyboardMarkup instance.
     *
     * @param  array<string, mixed>|array<int, array<int, KeyboardButton|array<string, mixed>>>  $items
     * @param  mixed  ...$args
     */
    public static function make($items = [], ...$args): self
    {
        if (is_array($items) && array_key_exists('keyboard', $items)) {
            return new self($items);
        }

        if (is_array($items)) {
            return new self(['keyboard' => $items]);
        }

        return new self([]);
    }

    /**
     * Set the keyboard rows.
     *
     * @param  array<int, array<int, KeyboardButton|array<string, mixed>>>  $keyboard
     */
    public function withKeyboard(array $keyboard): self
    {
        $this->items['keyboard'] = $keyboard;

        return $this;
    }

    /**
     * Set whether the keyboard is persistent.
     */
    public function withIsPersistent(?bool $isPersistent): self
    {
        $this->items['is_persistent'] = $isPersistent;

        return $this;
    }

    /**
     * Set whether the keyboard should be resized.
     */
    public function withResizeKeyboard(?bool $resizeKeyboard): self
    {
        $this->items['resize_keyboard'] = $resizeKeyboard;

        return $this;
    }

    /**
     * Set whether the keyboard is one-time.
     */
    public function withOneTimeKeyboard(?bool $oneTimeKeyboard): self
    {
        $this->items['one_time_keyboard'] = $oneTimeKeyboard;

        return $this;
    }

    /**
     * Set the input field placeholder.
     */
    public function withInputFieldPlaceholder(?string $inputFieldPlaceholder): self
    {
        $this->items['input_field_placeholder'] = $inputFieldPlaceholder;

        return $this;
    }

    /**
     * Set whether the keyboard is selective.
     */
    public function withSelective(?bool $selective): self
    {
        $this->items['selective'] = $selective;

        return $this;
    }

    /**
     * Pass True if the reply interface must be shown to the user.
     */
    public function withForceReply(?bool $forceReply): self
    {
        $this->items['force_reply'] = $forceReply;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function validate(): void
    {
        if (! isset($this->items['keyboard'])) {
            throw new TelegramValidationException('keyboard is required');
        }

        $rows = $this->items['keyboard'];
        $rows = $rows instanceof Collection ? $rows->all() : $rows;

        if (! is_array($rows) || $rows === []) {
            throw new TelegramValidationException('keyboard must be a non-empty array');
        }

        foreach ($rows as $row) {
            $rowItems = $row instanceof Collection ? $row->all() : $row;
            if (! is_array($rowItems) || $rowItems === []) {
                throw new TelegramValidationException('keyboard rows must be non-empty arrays');
            }

            foreach ($rowItems as $button) {
                if ($button instanceof KeyboardButton) {
                    $button->validate();

                    continue;
                }

                if (is_array($button)) {
                    KeyboardButton::fromArray($button)->validate();

                    continue;
                }

                throw new TelegramValidationException('keyboard must contain KeyboardButton items');
            }
        }

        if (isset($this->items['input_field_placeholder'])) {
            $placeholder = $this->items['input_field_placeholder'];
            $length = mb_strlen($placeholder);
            if ($length < 1 || $length > 64) {
                throw new TelegramValidationException('input_field_placeholder must be 1-64 characters');
            }
        }
    }

    /**
     * Array of button rows.
     *
     * @return array<int, array<int, KeyboardButton>>|null
     */
    public function getKeyboard(): ?array
    {
        $keyboard = $this->items['keyboard'] ?? null;

        if ($keyboard instanceof Collection) {
            return $keyboard->all();
        }

        return $keyboard;
    }

    /**
     * True if the keyboard is persistent.
     */
    public function getIsPersistent(): ?bool
    {
        return $this->items['is_persistent'] ?? null;
    }

    /**
     * True if the keyboard should be resized.
     */
    public function getResizeKeyboard(): ?bool
    {
        return $this->items['resize_keyboard'] ?? null;
    }

    /**
     * True if the keyboard is one-time.
     */
    public function getOneTimeKeyboard(): ?bool
    {
        return $this->items['one_time_keyboard'] ?? null;
    }

    /**
     * Input field placeholder.
     */
    public function getInputFieldPlaceholder(): ?string
    {
        return $this->items['input_field_placeholder'] ?? null;
    }

    /**
     * True if the keyboard is selective.
     */
    public function getSelective(): ?bool
    {
        return $this->items['selective'] ?? null;
    }

    /**
     * (Optional). True if the reply interface must be shown to the user.
     */
    public function getForceReply(): ?bool
    {
        return $this->items['force_reply'] ?? null;
    }
}
