<?php

namespace Telegram\Bot\Contracts;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Interface ApiRequestInterface.
 *
 * Contract for typed API request objects.
 */
interface ApiRequestInterface
{
    /**
     * Get the API method name (e.g., 'getUpdates', 'sendMessage').
     */
    public function getMethod(): string;

    /**
     * Convert the request to an array suitable for the API call.
     *
     * @return array<string, mixed>
     */
    public function toArray(): array;

    /**
     * Convert the request to a webhook payload format.
     * Used for webhook responses that include the method name.
     *
     * @return array<string, mixed>
     */
    public function toWebhookPayload(): array;

    /**
     * Validate the request parameters.
     *
     * @throws TelegramValidationException If validation fails
     */
    public function validate(): void;
}
