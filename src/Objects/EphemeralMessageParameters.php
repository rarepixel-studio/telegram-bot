<?php

namespace Telegram\Bot\Objects;

use Telegram\Bot\Contracts\ClientConstructibleObjectInterface;
use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Class EphemeralMessageParameters.
 *
 * Describes the parameters of an ephemeral message to send.
 *
 * @link https://core.telegram.org/bots/api#ephemeralmessageparameters
 */
class EphemeralMessageParameters extends BaseObject implements ClientConstructibleObjectInterface
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
     * Create an EphemeralMessageParameters instance.
     *
     * @param  array<string, mixed>|int  $items
     * @param  mixed  ...$args
     */
    public static function make($items = [], ...$args): self
    {
        if (is_int($items)) {
            return new self(['receiver_user_id' => $items]);
        }

        if (is_array($items)) {
            return new self($items);
        }

        return new self([]);
    }

    /**
     * Set the identifier of the user who will receive the message.
     */
    public function withReceiverUserId(int $receiverUserId): self
    {
        $this->items['receiver_user_id'] = $receiverUserId;

        return $this;
    }

    /**
     * Set the identifier of the callback query which triggered the message.
     */
    public function withCallbackQueryId(?string $callbackQueryId): self
    {
        $this->items['callback_query_id'] = $callbackQueryId;

        return $this;
    }

    /**
     * Pass True if the ephemeral message must be shown in place of the original message.
     */
    public function withReplaceCallbackQueryMessage(?bool $replaceCallbackQueryMessage): self
    {
        $this->items['replace_callback_query_message'] = $replaceCallbackQueryMessage;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function validate(): void
    {
        if (! isset($this->items['receiver_user_id'])) {
            throw new TelegramValidationException('receiver_user_id is required');
        }

        if (! is_int($this->items['receiver_user_id']) || $this->items['receiver_user_id'] <= 0) {
            throw new TelegramValidationException('receiver_user_id must be greater than 0');
        }

        if (array_key_exists('callback_query_id', $this->items) && $this->items['callback_query_id'] !== null) {
            if (! is_string($this->items['callback_query_id']) || $this->items['callback_query_id'] === '') {
                throw new TelegramValidationException('callback_query_id cannot be empty');
            }
        }
    }

    /**
     * Identifier of the user who will receive the message.
     */
    public function getReceiverUserId(): int
    {
        return $this->items['receiver_user_id'];
    }

    /**
     * (Optional). Identifier of the callback query which triggered the message.
     */
    public function getCallbackQueryId(): ?string
    {
        return $this->items['callback_query_id'] ?? null;
    }

    /**
     * (Optional). True if the ephemeral message must be shown in place of the original message.
     */
    public function getReplaceCallbackQueryMessage(): ?bool
    {
        return $this->items['replace_callback_query_message'] ?? null;
    }
}
