<?php

namespace Telegram\Bot\Objects;

/**
 * Class KeyboardButtonRequestManagedBot.
 *
 * Defines the criteria used to request a suitable managed bot.
 */
class KeyboardButtonRequestManagedBot extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Signed 32-bit identifier of the request, which will be received back in the ManagedBotCreated handler.
     */
    public function getRequestId(): int
    {
        return $this->items['request_id'];
    }

    /**
     * Optional. Suggested name for the new bot.
     */
    public function getSuggestedName(): ?string
    {
        return $this->items['suggested_name'] ?? null;
    }

    /**
     * Optional. Suggested username for the new bot.
     */
    public function getSuggestedUsername(): ?string
    {
        return $this->items['suggested_username'] ?? null;
    }
}
