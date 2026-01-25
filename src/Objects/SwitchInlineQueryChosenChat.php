<?php

namespace Telegram\Bot\Objects;

use Telegram\Bot\Contracts\ClientConstructibleObjectInterface;

/**
 * Class SwitchInlineQueryChosenChat.
 *
 * Represents an inline button that switches the current user to inline mode in a chosen chat.
 */
class SwitchInlineQueryChosenChat extends BaseObject implements ClientConstructibleObjectInterface
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
     * Create a SwitchInlineQueryChosenChat instance.
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
     * Set the default inline query.
     */
    public function withQuery(?string $query): self
    {
        $this->items['query'] = $query;

        return $this;
    }

    /**
     * Allow private chats with users.
     */
    public function withAllowUserChats(?bool $allowUserChats): self
    {
        $this->items['allow_user_chats'] = $allowUserChats;

        return $this;
    }

    /**
     * Allow private chats with bots.
     */
    public function withAllowBotChats(?bool $allowBotChats): self
    {
        $this->items['allow_bot_chats'] = $allowBotChats;

        return $this;
    }

    /**
     * Allow group and supergroup chats.
     */
    public function withAllowGroupChats(?bool $allowGroupChats): self
    {
        $this->items['allow_group_chats'] = $allowGroupChats;

        return $this;
    }

    /**
     * Allow channel chats.
     */
    public function withAllowChannelChats(?bool $allowChannelChats): self
    {
        $this->items['allow_channel_chats'] = $allowChannelChats;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function validate(): void
    {
        // No validation rules beyond optional fields.
    }

    /**
     * Default inline query.
     */
    public function getQuery(): ?string
    {
        return $this->items['query'] ?? null;
    }

    /**
     * True if private chats with users can be chosen.
     */
    public function getAllowUserChats(): ?bool
    {
        return $this->items['allow_user_chats'] ?? null;
    }

    /**
     * True if private chats with bots can be chosen.
     */
    public function getAllowBotChats(): ?bool
    {
        return $this->items['allow_bot_chats'] ?? null;
    }

    /**
     * True if group and supergroup chats can be chosen.
     */
    public function getAllowGroupChats(): ?bool
    {
        return $this->items['allow_group_chats'] ?? null;
    }

    /**
     * True if channel chats can be chosen.
     */
    public function getAllowChannelChats(): ?bool
    {
        return $this->items['allow_channel_chats'] ?? null;
    }
}
