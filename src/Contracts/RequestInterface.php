<?php

namespace Telegram\Bot\Contracts;

/**
 * Interface RequestInterface.
 *
 * Contract for Telegram request implementations.
 */
interface RequestInterface
{
    /**
     * Return the bot access token for this request.
     */
    public function getAccessToken(): ?string;

    /**
     * Return the API Endpoint for this request.
     */
    public function getEndpoint(): string;

    /**
     * Return the params for this request.
     */
    public function getParams(): array;

    /**
     * Return the file params.
     */
    public function getFiles(): array;

    /**
     * Get the guzzle http options.
     */
    public function getOptions(): array;

    /**
     * Return the headers for this request.
     */
    public function getHeaders(): array;

    /**
     * Check if this is an asynchronous request (non-blocking).
     */
    public function isAsyncRequest(): bool;

    /**
     * Get timeout.
     */
    public function getTimeOut(): int;

    /**
     * Get connection timeout.
     */
    public function getConnectTimeOut(): int;

    /**
     * Set the attachments.
     *
     * @return $this
     */
    public function setAttachments(array $attachments): self;
}
