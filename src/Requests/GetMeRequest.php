<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the getMe method.
 *
 * A simple method for testing your bot's authentication token.
 * Requires no parameters. Returns basic information about the bot in form of a User object.
 *
 * @link https://core.telegram.org/bots/api#getme
 */
class GetMeRequest extends TelegramApiRequest
{
    public function getMethod(): string
    {
        return 'getMe';
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
