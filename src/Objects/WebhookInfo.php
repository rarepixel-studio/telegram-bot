<?php

namespace Telegram\Bot\Objects;

class WebhookInfo extends BaseObject
{
    /**
     * Property relations.
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Webhook URL, may be empty if webhook is not set up.
     */
    public function getUrl(): string
    {
        return $this->items['url'];
    }

    /**
     * True, if a custom certificate was provided for webhook certificate checks.
     */
    public function getHasCustomCertificate(): bool
    {
        return $this->items['has_custom_certificate'];
    }

    /**
     * Number of updates awaiting delivery.
     */
    public function getPendingUpdateCount(): int
    {
        return $this->items['pending_update_count'];
    }

    /**
     * (Optional). Unix time for the most recent error that happened when trying to deliver an update via webhook.
     */
    public function getLastErrorDate(): ?int
    {
        return $this->items['last_error_date'] ?? null;
    }

    /**
     * (Optional). Error message in human-readable format for the most recent error that happened when trying to deliver an update via webhook.
     */
    public function getLastErrorMessage(): ?string
    {
        return $this->items['last_error_message'] ?? null;
    }
}
