<?php

namespace Telegram\Bot\Exceptions;

class TelegramMalformedResponseException extends TelegramResponseException
{
    public static int $retryAfter = 5;

    public function retryAfter(): int
    {
        return static::$retryAfter;
    }
}
