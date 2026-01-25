<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the getMyStarBalance method.
 *
 * Use this method to get the current bot's Star balance.
 *
 * @link https://core.telegram.org/bots/api#getmystarbalance
 */
class GetMyStarBalanceRequest extends TelegramApiRequest
{
    public function getMethod(): string
    {
        return 'getMyStarBalance';
    }

    public function validate(): void
    {
        // No parameters
    }

    public function buildParams(): array
    {
        return [];
    }
}
