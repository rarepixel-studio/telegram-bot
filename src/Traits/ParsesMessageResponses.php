<?php

namespace Telegram\Bot\Traits;

use Closure;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\TelegramResponse;

/** @internal */
trait ParsesMessageResponses
{
    /**
     * @return Closure(TelegramResponse): Message Parser for a single message in a Telegram response envelope.
     */
    private function messageResponseParser(): Closure
    {
        return function (TelegramResponse $response) {
            return new Message($response->getDecodedBody());
        };
    }
}
