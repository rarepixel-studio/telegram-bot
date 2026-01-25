<?php

namespace Telegram\Bot\HttpClients;

use GuzzleHttp\Client;
use GuzzleHttp\Promise\PromiseInterface;
use GuzzleHttp\RequestOptions;
use Telegram\Bot\Contracts\HttpClientInterface;

/**
 * Class GuzzleHttpClient.
 */
class GuzzleHttpClient implements HttpClientInterface
{
    /**
     * HTTP client.
     */
    protected Client $client;

    public function __construct(?Client $client = null)
    {
        $this->client = $client ?: new Client;
    }

    /**
     * @param  int  $timeOut
     * @param  bool  $isAsyncRequest
     * @param  int  $connectTimeOut
     */
    public function send($url, array $headers, array $options, $timeOut, $isAsyncRequest, $connectTimeOut): PromiseInterface
    {
        $body = $options['body'] ?? null;
        $options = $this->getOptions($headers, $body, $options, $timeOut, $isAsyncRequest, $connectTimeOut);

        return $this->client->requestAsync('POST', $url, $options);
    }

    /**
     * Prepares and returns request options.
     */
    protected function getOptions(array $headers, $body, $options, $timeOut, $isAsyncRequest, int $connectTimeOut): array
    {
        $default_options = [
            RequestOptions::HEADERS => $headers,
            RequestOptions::BODY => $body,
            RequestOptions::TIMEOUT => $timeOut,
            RequestOptions::CONNECT_TIMEOUT => $connectTimeOut,
            RequestOptions::SYNCHRONOUS => ! $isAsyncRequest,
            RequestOptions::HTTP_ERRORS => false,
        ];

        return array_merge($default_options, $options);
    }
}
