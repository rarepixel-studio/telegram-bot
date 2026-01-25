<?php

namespace Telegram\Bot\Traits;

use Closure;
use Psr\Http\Message\StreamInterface;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\FileUpload\InputFileInterface;
use Telegram\Bot\Objects\InputMedia;
use Telegram\Bot\Objects\Message;
use Telegram\Bot\TelegramRequest;
use Telegram\Bot\TelegramResponse;

/**
 * Trait HasHttpRequests.
 */
trait HasHttpRequests
{
    /**
     * Sends a POST request to Telegram Bot API and returns the result.
     *
     * @throws TelegramSDKException
     */
    protected function post(string $endpoint, array $params = [], array $files = [], array $attachments = []): TelegramResponse
    {
        $token = $this->extractAccessToken($params);

        return $this->sendRequest($endpoint, $params, $files, $attachments, $token);
    }

    /**
     * Sends a multipart/form-data request to Telegram Bot API and returns the result.
     * Used primarily for file uploads.
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    protected function uploadFile(string $endpoint, array $params, array $files, ?Closure $parser = null): mixed
    {
        foreach ($files as $key) {
            if (array_key_exists($key, $params) && ! is_resource($params[$key]) && ! $params[$key] instanceof StreamInterface) {
                if ($params[$key] instanceof InputFileInterface) {
                    $params[$key] = $params[$key]->open();
                } else {
                    $validUrl = filter_var($params[$key], FILTER_VALIDATE_URL);
                    $params[$key] = (is_file($params[$key]) || $validUrl) ? (new InputFile($params[$key]))->open() : (string) $params[$key];
                }
            }
        }

        $response = $this->post($endpoint, $params, $files);

        if (! $parser) {
            $parser = function (TelegramResponse $response) {
                return new Message($response->getDecodedBody());
            };
        }

        return $this->prepareResponse($parser, $response);
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
     */
    protected function extractInputMedia(array &$params): array
    {
        $attachments = [];
        if (isset($params['media']) && is_array($params['media'])) {
            foreach ($params['media'] as $key => $media) {
                if ($media instanceof InputMedia) {
                    $part = $media->extractAttachment('__ATTACHED_FILE__'.$key);
                    $thumb = $media->extractAttachment('__ATTACHED_THUMB__'.$key, 'thumb');
                    $thumbnail = $media->extractAttachment('__ATTACHED_THUMBNAIL__'.$key, 'thumbnail');
                    $cover = $media->extractAttachment('__ATTACHED_COVER__'.$key, 'cover');
                    $params['media'][$key] = $media->toArray();
                    if ($part) {
                        $attachments[] = $part;
                    }
                    if ($thumb) {
                        $attachments[] = $thumb;
                    }
                    if ($thumbnail) {
                        $attachments[] = $thumbnail;
                    }
                    if ($cover) {
                        $attachments[] = $cover;
                    }
                }
            }
            $params['media'] = json_encode($params['media']);
        }

        return $attachments;
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
