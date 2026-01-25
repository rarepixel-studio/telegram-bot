<?php

namespace Telegram\Bot\Objects;

/**
 * Class MessageOriginHiddenUser.
 *
 * The message was originally sent by an unknown user.
 */
class MessageOriginHiddenUser extends MessageOrigin
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Name of the user that sent the message originally.
     */
    public function getSenderUserName(): string
    {
        return $this->items['sender_user_name'];
    }
}
