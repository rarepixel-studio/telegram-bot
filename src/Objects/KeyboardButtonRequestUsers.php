<?php

namespace Telegram\Bot\Objects;

use Telegram\Bot\Contracts\ClientConstructibleObjectInterface;
use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Class KeyboardButtonRequestUsers.
 *
 * Defines the criteria used to request suitable users.
 */
class KeyboardButtonRequestUsers extends BaseObject implements ClientConstructibleObjectInterface
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
     * Create a KeyboardButtonRequestUsers instance.
     *
     * @param  array<string, mixed>|int  $items
     * @param  mixed  ...$args
     */
    public static function make($items = [], ...$args): self
    {
        if (is_int($items)) {
            return new self(['request_id' => $items]);
        }

        if (is_array($items)) {
            return new self($items);
        }

        return new self([]);
    }

    /**
     * Set whether to request bot users.
     */
    public function withUserIsBot(?bool $userIsBot): self
    {
        $this->items['user_is_bot'] = $userIsBot;

        return $this;
    }

    /**
     * Set whether to request premium users.
     */
    public function withUserIsPremium(?bool $userIsPremium): self
    {
        $this->items['user_is_premium'] = $userIsPremium;

        return $this;
    }

    /**
     * Set the maximum number of users to select.
     */
    public function withMaxQuantity(?int $maxQuantity): self
    {
        $this->items['max_quantity'] = $maxQuantity;

        return $this;
    }

    /**
     * Request users' names.
     */
    public function withRequestName(?bool $requestName): self
    {
        $this->items['request_name'] = $requestName;

        return $this;
    }

    /**
     * Request users' usernames.
     */
    public function withRequestUsername(?bool $requestUsername): self
    {
        $this->items['request_username'] = $requestUsername;

        return $this;
    }

    /**
     * Request users' photos.
     */
    public function withRequestPhoto(?bool $requestPhoto): self
    {
        $this->items['request_photo'] = $requestPhoto;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function validate(): void
    {
        if (! isset($this->items['request_id'])) {
            throw new TelegramValidationException('request_id is required');
        }

        if (isset($this->items['max_quantity'])) {
            $maxQuantity = $this->items['max_quantity'];
            if (! is_int($maxQuantity) || $maxQuantity < 1 || $maxQuantity > 10) {
                throw new TelegramValidationException('max_quantity must be between 1 and 10');
            }
        }
    }

    /**
     * Signed 32-bit identifier of the request.
     */
    public function getRequestId(): int
    {
        return $this->items['request_id'];
    }

    /**
     * True if requesting bots.
     */
    public function getUserIsBot(): ?bool
    {
        return $this->items['user_is_bot'] ?? null;
    }

    /**
     * True if requesting premium users.
     */
    public function getUserIsPremium(): ?bool
    {
        return $this->items['user_is_premium'] ?? null;
    }

    /**
     * Maximum number of users to select.
     */
    public function getMaxQuantity(): ?int
    {
        return $this->items['max_quantity'] ?? null;
    }

    /**
     * True if requesting names.
     */
    public function getRequestName(): ?bool
    {
        return $this->items['request_name'] ?? null;
    }

    /**
     * True if requesting usernames.
     */
    public function getRequestUsername(): ?bool
    {
        return $this->items['request_username'] ?? null;
    }

    /**
     * True if requesting photos.
     */
    public function getRequestPhoto(): ?bool
    {
        return $this->items['request_photo'] ?? null;
    }
}
