<?php

namespace Telegram\Bot\Contracts;

use GuzzleHttp\Promise\PromiseInterface;

/**
 * Interface HttpClientInterface.
 *
 * Contract for HTTP client implementations.
 */
interface HttpClientInterface
{
    /**
     * Send an HTTP request to the API.
     *
     * @param  string  $url  The URL to send the request to
     * @param  array  $headers  Request headers
     * @param  array  $options  Request options (form_params, multipart, etc.)
     * @param  int  $timeOut  Request timeout in seconds
     * @param  bool  $isAsyncRequest  Whether the request is asynchronous
     * @param  int  $connectTimeOut  Connection timeout in seconds
     */
    public function send($url, array $headers, array $options, $timeOut, $isAsyncRequest, $connectTimeOut): PromiseInterface;
}
