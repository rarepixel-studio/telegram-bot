<?php

namespace Telegram\Bot\Objects;

use Telegram\Bot\Contracts\ClientConstructibleObjectInterface;
use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Class ForceReply.
 *
 * Shows the reply interface to the user.
 */
class ForceReply extends BaseObject implements ClientConstructibleObjectInterface
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
     * Create a ForceReply instance.
     *
     * @param  array<string, mixed>|bool  $items
     */
    public static function make($items = []): self
    {
        if (is_bool($items)) {
            return new self(['force_reply' => $items]);
        }

        if (is_array($items)) {
            return new self($items);
        }

        return new self(['force_reply' => true]);
    }

    /**
     * Set whether to force reply.
     */
    public function withForceReply(bool $forceReply): self
    {
        $this->items['force_reply'] = $forceReply;

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
     * Set whether reply is selective.
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
        if (($this->items['force_reply'] ?? null) !== true) {
            throw new TelegramValidationException('force_reply must be true');
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
     * Shows the reply interface to the user.
     */
    public function getForceReply(): bool
    {
        return $this->items['force_reply'];
    }

    /**
     * Input field placeholder.
     */
    public function getInputFieldPlaceholder(): ?string
    {
        return $this->items['input_field_placeholder'] ?? null;
    }

    /**
     * True if reply is selective.
     */
    public function getSelective(): ?bool
    {
        return $this->items['selective'] ?? null;
    }
}
