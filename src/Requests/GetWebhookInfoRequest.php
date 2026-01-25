<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the getWebhookInfo method.
 *
 * Use this method to get current webhook status. Requires no parameters.
 * On success, returns a WebhookInfo object. If the bot is using getUpdates,
 * will return an object with the url field empty.
 *
 * @link https://core.telegram.org/bots/api#getwebhookinfo
 */
class GetWebhookInfoRequest extends TelegramApiRequest
{
    public function getMethod(): string
    {
        return 'getWebhookInfo';
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
