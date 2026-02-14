<?php

namespace Telegram\Bot\Objects;

/**
 * Class ChatOwnerLeft.
 *
 * Represents a service message about the owner of the chat leaving.
 * Currently holds no information.
 *
 * @link https://core.telegram.org/bots/api#chatownerleft
 */
class ChatOwnerLeft extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}
