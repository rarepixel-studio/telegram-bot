<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the getAvailableGifts method.
 *
 * Use this method to get the list of gifts that can be sent by the bot to users.
 *
 * @link https://core.telegram.org/bots/api#getavailablegifts
 */
class GetAvailableGiftsRequest extends TelegramApiRequest
{
    public function __construct() {}

    public function getMethod(): string
    {
        return 'getAvailableGifts';
    }

    public function validate(): void {}

    public function buildParams(): array
    {
        return [];
    }
}
