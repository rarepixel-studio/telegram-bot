<?php

namespace Telegram\Bot;

use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;
use Telegram\Bot\Contracts\ClientInterface;
use Telegram\Bot\Contracts\HttpClientInterface;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\HttpClients\GuzzleHttpClient;

/**
 * Class TelegramClient.
 */
class TelegramClient implements ClientInterface
{
    /**
     * @const string Telegram Bot API URL.
     */
    const BASE_BOT_URL = 'https://api.telegram.org/bot';

    /**
     * @var HttpClientInterface HTTP Client
     */
    protected HttpClientInterface $httpClientHandler;

    /**
     * Instantiates a new TelegramClient object.
     */
    public function __construct(?HttpClientInterface $httpClientHandler = null)
    {
        $this->httpClientHandler = $httpClientHandler ?: new GuzzleHttpClient;
    }

    /**
     * Returns the HTTP client handler.
     */
    public function getHttpClientHandler(): HttpClientInterface
    {
        return $this->httpClientHandler;
    }

    /**
     * Returns the base Bot URL.
     */
    public function getBaseBotUrl(): string
    {
        return static::BASE_BOT_URL;
    }

    /**
     * Prepares the API request for sending to the client handler.
     */
    protected function prepareRequest(TelegramRequest $request): array
    {
        $url = $this->getBaseBotUrl().$request->getAccessToken().'/'.$request->getEndpoint();

        return [
            $url,
            $request->getHeaders(),
            $request->isAsyncRequest(),
        ];
    }

    /**
     * Send an API request and process the result.
     *
     *
     * @throws TelegramSDKException
     */
    public function sendRequest(TelegramRequest $request): PromiseInterface
    {
        [$url, $headers, $isAsyncRequest] = $this->prepareRequest($request);

        $timeOut = $request->getTimeOut();
        $connectTimeOut = $request->getConnectTimeOut();

        $options = $request->getOptions();

        return $this->httpClientHandler->send($url, $headers, $options, $timeOut, $isAsyncRequest, $connectTimeOut);
    }

    /**
     * Creates response object.
     */
    protected function getResponse(TelegramRequest $request, ResponseInterface|PromiseInterface $response): TelegramResponse
    {
        return new TelegramResponse($request, $response);
    }
}
