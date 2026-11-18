<?php

namespace Telegram\Bot\Traits;

use Closure;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Requests\RequestSerializer;
use Telegram\Bot\TelegramRequest;
use Telegram\Bot\TelegramResponse;

/**
 * Trait HasHttpRequests.
 */
trait HasHttpRequests
{
    use ParsesMessageResponses;

    /**
     * Sends a POST request to Telegram Bot API and returns the result.
     *
     * @param  string  $endpoint  Telegram method name.
     * @param  array<string, mixed>  $params  Outbound parameters.
     * @param  array<int, string>  $files  Multipart file field names.
     * @param  list<array{name: string, contents: mixed}>  $attachments  Additional multipart parts.
     * @return TelegramResponse The response for the dispatched request.
     *
     * @throws TelegramSDKException
     */
    protected function post(string $endpoint, array $params = [], array $files = [], array $attachments = []): TelegramResponse
    {
        $params = RequestSerializer::preparePost($params);

        $token = $this->extractAccessToken($params);

        return $this->sendRequest($endpoint, $params, $files, $attachments, $token);
    }

    /**
     * Sends a multipart/form-data request to Telegram Bot API and returns the result.
     * Used primarily for file uploads.
     *
     * @param  string  $endpoint  Telegram method name.
     * @param  array<string, mixed>  $params  Outbound parameters.
     * @param  array<int, string>  $files  Multipart file field names.
     * @param  Closure|null  $parser  Custom response parser.
     * @return mixed The parsed response, or a closure that resolves it in async mode.
     *
     * @throws TelegramValidationException|TelegramSDKException
     * @throws \RuntimeException If the upload stream cannot be opened.
     * @throws \TypeError If a raw file value cannot be passed to the filesystem.
     */
    protected function uploadFile(string $endpoint, array $params, array $files, ?Closure $parser = null): mixed
    {
        $params = RequestSerializer::prepareFiles($params, $files);

        $response = $this->post($endpoint, $params, $files);

        return $this->prepareResponse($parser ?? $this->messageResponseParser(), $response);
    }

    /**
     * Extract access token from params.
     */
    protected function extractAccessToken(array &$params): string
    {
        if (array_key_exists('_AccessToken_', $params)) {
            $token = $params['_AccessToken_'];
            unset($params['_AccessToken_']);

            return $token;
        } else {
            return $this->accessToken;
        }
    }

    /**
     * Sends a request to Telegram Bot API and returns the result.
     *
     * @throws TelegramSDKException
     */
    protected function sendRequest(string $endpoint, array $params, array $files, array $attachments, string $token): TelegramResponse
    {
        $request = $this->request($endpoint, $params, $files, $attachments, $token);

        $this->sending($request);

        $time = microtime(true);

        $promise = $this->client->sendRequest($request);

        $response = new TelegramResponse($request, $promise);

        $handler = function () use ($response, $time) {
            $elapsedTime = microtime(true) - $time;

            if ($response->isError()) {
                $this->rejected($response, $elapsedTime);
            } else {
                $this->fulfilled($response, $elapsedTime);
            }
        };

        $promise->then($handler, $handler);

        return $response;
    }

    /**
     * Instantiates a new TelegramRequest entity.
     */
    protected function request(string $endpoint, array $params, array $files, array $attachments, string $token): TelegramRequest
    {
        return (new TelegramRequest(
            $token,
            $endpoint,
            $params,
            $files,
            $this->isAsyncRequest,
            $this->timeOut,
            $this->connectTimeOut
        ))->setAttachments($attachments);
    }

    /**
     * Send the Closure $parser if Api is in async mode, otherwise send the return value of the Closure $parser.
     *
     * @throws TelegramValidationException
     * @throws TelegramSDKException
     */
    protected function prepareResponse(Closure $parser, TelegramResponse $response): mixed
    {
        $prepared = function () use ($parser, $response) {
            $response->wait()->throwException();

            return $parser($response);
        };

        if ($this->isAsyncRequest) {
            $this->waitingResponses[] = $response;

            return $prepared;
        }

        return $prepared();
    }

    /**
     * Extracts attachments from InputMedia objects.
     *
     * @param  array<string, mixed>  $params  Parameters whose media field will be serialized.
     * @return list<array{name: string, contents: mixed}>
     *
     * @throws TelegramSDKException If an attachment cannot be read.
     * @throws \RuntimeException If an attachment stream cannot be opened.
     */
    protected function extractInputMedia(array &$params): array
    {
        return RequestSerializer::extractInputMedia($params);
    }

    /**
     * Fire the sending event.
     */
    protected function sending(TelegramRequest $request): void
    {
        if ($this->onSending !== null) {
            ($this->onSending)($request);
        }
    }

    /**
     * Fire the fulfilled event.
     */
    protected function fulfilled(TelegramResponse $response, float $elapsedTime): void
    {
        if ($this->onFulfilled !== null) {
            ($this->onFulfilled)($response, $elapsedTime);
        }
    }

    /**
     * Fire the rejected event.
     */
    protected function rejected(TelegramResponse $response, float $elapsedTime): void
    {
        if ($this->onRejected !== null) {
            ($this->onRejected)($response, $elapsedTime);
        }
    }
}
