<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class ChatShared.
 *
 * Contains information about a chat that was shared with the bot.
 */
class ChatShared extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'photo' => PhotoSize::class,
        ];
    }

    /**
     * Identifier of the request.
     */
    public function getRequestId(): int
    {
        return $this->items['request_id'];
    }

    /**
     * Identifier of the shared chat.
     */
    public function getChatId(): int
    {
        return $this->items['chat_id'];
    }

    /**
     * (Optional). Title of the chat.
     */
    public function getTitle(): ?string
    {
        return $this->items['title'] ?? null;
    }

    /**
     * (Optional). Username of the chat.
     */
    public function getUsername(): ?string
    {
        return $this->items['username'] ?? null;
    }

    /**
     * (Optional). Available sizes of the chat photo.
     *
     * @return Collection<int, PhotoSize>|null
     */
    public function getPhoto(): ?Collection
    {
        return $this->items['photo'] ?? null;
    }
}
