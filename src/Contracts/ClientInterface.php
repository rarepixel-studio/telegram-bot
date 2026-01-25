<?php

namespace Telegram\Bot\Contracts;

use GuzzleHttp\Promise\PromiseInterface;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\TelegramRequest;

/**
 * Interface ClientInterface.
 *
 * Contract for Telegram HTTP client implementations.
 */
interface ClientInterface
{
    /**
     * Returns the HTTP client handler.
     */
    public function getHttpClientHandler(): HttpClientInterface;

    /**
     * Returns the base Bot URL.
     */
    public function getBaseBotUrl(): string;

    /**
     * Send an API request and process the result.
     *
     * @throws TelegramSDKException
     */
    public function sendRequest(TelegramRequest $request): PromiseInterface;
}
