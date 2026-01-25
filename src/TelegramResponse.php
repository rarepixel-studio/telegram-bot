<?php

namespace Telegram\Bot;

use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Promise\PromiseInterface;
use Psr\Http\Message\ResponseInterface;
use Telegram\Bot\Contracts\ResponseInterface as TelegramResponseInterface;
use Telegram\Bot\Exceptions\TelegramResponseException;
use Telegram\Bot\Exceptions\TelegramSDKException;

/**
 * Class TelegramResponse.
 *
 * Handles the response from Telegram API.
 */
class TelegramResponse implements TelegramResponseInterface
{
    /**
     * @var string The body string of the API response
     */
    protected ?string $body = null;

    /**
     * @var array The decoded body of the API response.
     */
    protected ?array $decodedBody = null;

    /**
     * @var TelegramRequest The original request that returned this response.
     */
    protected TelegramRequest $request;

    protected PromiseInterface|ResponseInterface $response;

    protected ?RequestException $requestException = null;

    /**
     * Gets the relevant data from the Http client.
     */
    public function __construct(TelegramRequest $request, PromiseInterface $response)
    {
        $this->request = $request;
        $this->response = $response;
    }

    /**
     * Return the original request that returned this response.
     */
    public function getRequest(): TelegramRequest
    {
        return $this->request;
    }

    /**
     * Gets the HTTP status code.
     */
    public function getHttpStatusCode(): int
    {
        $this->wait();

        return $this->response instanceof ResponseInterface ? $this->response->getStatusCode() : 0;
    }

    /**
     * Return the bot access token that was used for this request.
     */
    public function getAccessToken(): ?string
    {
        return $this->request->getAccessToken();
    }

    /**
     * Return the HTTP headers for this response.
     */
    public function getHeaders(): array
    {
        $this->wait();

        return $this->response instanceof ResponseInterface ? $this->response->getHeaders() : [];
    }

    /**
     * Return the raw body response.
     */
    public function getBody(): string
    {
        if (is_null($this->body)) {
            $this->wait();

            $this->body = $this->response instanceof ResponseInterface ? (string) $this->response->getBody() : '';
        }

        return $this->body;
    }

    /**
     * Return the decoded body response.
     */
    public function getDecodedBody(): array
    {
        if (is_null($this->decodedBody)) {
            $this->decodeBody();
        }

        return $this->decodedBody;
    }

    /**
     * Return the result.
     */
    public function getResult(): mixed
    {
        return $this->getDecodedBody()['result'];
    }

    public function getRequestException(): ?RequestException
    {
        return $this->requestException;
    }

    /**
     * Checks if response is an error.
     */
    public function isError(): bool
    {
        $body = $this->getDecodedBody();

        return $this->getRequestException() || ! isset($body['ok']) || ($body['ok'] !== true) || ! isset($body['result']);
    }

    /**
     * Throws a TelegramResponseException exception if this is an error.
     *
     *
     * @return $this
     *
     * @throws TelegramSDKException
     */
    public function throwException(): self
    {
        if ($this->isError()) {
            throw TelegramResponseException::create($this);
        }

        return $this;
    }

    /**
     * Converts raw API response to proper decoded response.
     */
    protected function decodeBody(): void
    {
        $this->wait();

        $this->decodedBody = json_decode($body = $this->getBody(), true);

        if (! is_array($this->decodedBody)) {
            $this->decodedBody = [];
        }
    }

    /**
     * Wait for the promise
     *
     * @return $this
     */
    public function wait(): self
    {
        if (! $this->ready()) {
            try {
                $this->response = $this->response->wait();
            } catch (RequestException $e) {
                $this->requestException = $e;
                $this->response = $e->getResponse();
            }
        }

        return $this;
    }

    /**
     * Whether the response has already been waited for.
     */
    public function ready(): bool
    {
        return ! $this->response instanceof PromiseInterface;
    }
}
