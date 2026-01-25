<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the close method.
 *
 * Use this method to close the bot instance before moving it from one local
 * server to another. You need to delete the webhook before calling this method
 * to ensure that the bot isn't launched again after server restart.
 *
 * @link https://core.telegram.org/bots/api#close
 */
class CloseRequest extends TelegramApiRequest
{
    /**
     * {@inheritDoc}
     */
    public function getMethod(): string
    {
        return 'close';
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
