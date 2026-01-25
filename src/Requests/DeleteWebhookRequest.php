<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the deleteWebhook method.
 *
 * @link https://core.telegram.org/bots/api#deletewebhook
 */
class DeleteWebhookRequest extends TelegramApiRequest
{
    protected ?bool $dropPendingUpdates = null;

    /**
     * {@inheritDoc}
     */
    public function getMethod(): string
    {
        return 'deleteWebhook';
    }

    /**
     * Set whether to drop pending updates.
     *
     * @param  bool  $dropPendingUpdates  Pass true to drop pending updates
     * @return $this
     */
    public function setDropPendingUpdates(bool $dropPendingUpdates): self
    {
        $this->dropPendingUpdates = $dropPendingUpdates;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function validate(): void
    {
        // No validation required for deleteWebhook
    }

    /**
     * {@inheritDoc}
     */
    protected function buildParams(): array
    {
        return [
            'drop_pending_updates' => $this->dropPendingUpdates,
        ];
    }
}
