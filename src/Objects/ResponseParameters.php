<?php

namespace Telegram\Bot\Objects;

class ResponseParameters extends BaseObject
{
    /**
     * Property relations.
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * (Optional). The group has been migrated to a supergroup with the specified identifier.
     */
    public function getMigrateToChatId(): ?int
    {
        return $this->items['migrate_to_chat_id'] ?? null;
    }

    /**
     * (Optional). In case of exceeding flood control, the number of seconds left to wait before the request can be repeated.
     */
    public function getRetryAfter(): ?int
    {
        return $this->items['retry_after'] ?? null;
    }
}
