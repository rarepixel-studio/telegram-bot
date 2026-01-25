<?php

namespace Telegram\Bot\Objects;

/**
 * Class MessageId.
 *
 * @link https://core.telegram.org/bots/api#messageid
 *
 * @property int $message_id Unique message identifier.
 */
class MessageId extends BaseObject
{
    public function relations(): array
    {
        return [];
    }
}
