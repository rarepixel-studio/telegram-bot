<?php

namespace Telegram\Bot\Contracts;

use GuzzleHttp\Exception\RequestException;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\TelegramRequest;

/**
 * Interface ResponseInterface.
 *
 * Contract for Telegram response implementations.
 */
interface ResponseInterface
{
    /**
     * Return the original request that returned this response.
     */
    public function getRequest(): TelegramRequest;

    /**
     * Gets the HTTP status code.
     */
    public function getHttpStatusCode(): int;

    /**
     * Return the bot access token that was used for this request.
     */
    public function getAccessToken(): ?string;

    /**
     * Return the HTTP headers for this response.
     */
    public function getHeaders(): array;

    /**
     * Return the raw body response.
     */
    public function getBody(): string;

    /**
     * Return the decoded body response.
     */
    public function getDecodedBody(): array;

    /**
     * Return the result.
     */
    public function getResult(): mixed;

    /**
     * Get request exception if any.
     */
    public function getRequestException(): ?RequestException;

    /**
     * Checks if response is an error.
     */
    public function isError(): bool;

    /**
     * Throws a TelegramResponseException exception if this is an error.
     *
     *
     * @return $this
     *
     * @throws TelegramSDKException
     */
    public function throwException(): self;

    /**
     * Wait for the promise.
     *
     * @return $this
     */
    public function wait(): self;

    /**
     * Whether the response has already been waited for.
     */
    public function ready(): bool;
}
