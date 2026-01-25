<?php

namespace Telegram\Bot\Objects;

/**
 * Class MessageOriginUser.
 *
 * The message was originally sent by a known user.
 */
class MessageOriginUser extends MessageOrigin
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'sender_user' => User::class,
        ];
    }

    /**
     * User that sent the message originally.
     */
    public function getSenderUser(): User
    {
        return $this->items['sender_user'];
    }
}
