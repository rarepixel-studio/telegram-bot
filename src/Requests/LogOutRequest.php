<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the logOut method.
 *
 * Use this method to log out from the cloud Bot API server before launching
 * the bot locally. You must log out the bot before running it locally,
 * otherwise there is no guarantee that the bot will receive updates.
 *
 * @link https://core.telegram.org/bots/api#logout
 */
class LogOutRequest extends TelegramApiRequest
{
    /**
     * {@inheritDoc}
     */
    public function getMethod(): string
    {
        return 'logOut';
    }

    /**
     * {@inheritDoc}
     */
    public function validate(): void
    {
        // No parameters to validate
    }

    /**
     * {@inheritDoc}
     */
    protected function buildParams(): array
    {
        return [];
    }
}
