<?php

namespace Telegram\Bot;

use Telegram\Bot\Contracts\RequestInterface;

/**
 * Class TelegramRequest.
 *
 * Builds Telegram Bot API Request Entity.
 */
class TelegramRequest implements RequestInterface
{
    /**
     * @var string|null The bot access token to use for this request.
     */
    protected ?string $accessToken;

    /**
     * @var string The API endpoint for this request.
     */
    protected string $endpoint;

    /**
     * @var array The parameters to send with this request.
     */
    protected array $params;

    /**
     * The file params.
     */
    protected array $files;

    /**
     * Indicates if the request to Telegram will be asynchronous (non-blocking).
     */
    protected bool $isAsyncRequest;

    /**
     * Timeout of the request in seconds.
     */
    protected int $timeOut;

    /**
     * Connection timeout of the request in seconds.
     */
    protected int $connectTimeOut;

    /**
     * Multipart attachments.
     */
    protected array $attachments = [];

    /**
     * Creates a new Request entity.
     */
    public function __construct(string $accessToken, string $endpoint, array $params, array $files, bool $isAsyncRequest, int $timeOut, int $connectTimeOut)
    {
        $this->accessToken = $accessToken;
        $this->endpoint = $endpoint;
        $this->params = $params;
        $this->files = $files;
        $this->isAsyncRequest = $isAsyncRequest;
        $this->timeOut = $timeOut;
        $this->connectTimeOut = $connectTimeOut;
    }

    /**
     * Return the bot access token for this request.
     */
    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    /**
     * Return the API Endpoint for this request.
     */
    public function getEndpoint(): string
    {
        return $this->endpoint;
    }

    /**
     * Return the params for this request.
     */
    public function getParams(): array
    {
        return $this->params;
    }

    /**
     * Return the file params.
     */
    public function getFiles(): array
    {
        return $this->files;
    }

    /**
     * Get the guzzle http options.
     */
    public function getOptions(): array
    {
        if (! $this->files && ! $this->attachments) {
            return ['form_params' => $this->params];
        }

        $i = 0;
        $multipart = [];
        foreach ($this->params as $name => $contents) {
            if (is_null($contents)) {
                continue;
            }

            $multipart[$i]['name'] = $name;
            $multipart[$i]['contents'] = $contents;
            $i++;
        }

        return ['multipart' => array_merge($multipart, $this->attachments)];
    }

    /**
     * Return the headers for this request.
     */
    public function getHeaders(): array
    {
        return [
            'User-Agent' => 'Telegram Bot PHP SDK v'.Api::VERSION.' - (https://github.com/halaei/telegram-bot)',
        ];
    }

    /**
     * Check if this is an asynchronous request (non-blocking).
     */
    public function isAsyncRequest(): bool
    {
        return $this->isAsyncRequest;
    }

    public function getTimeOut(): int
    {
        return $this->timeOut;
    }

    public function getConnectTimeOut(): int
    {
        return $this->connectTimeOut;
    }

    /**
     * Set the attachments.
     *
     *
     * @return $this
     */
    public function setAttachments(array $attachments): self
    {
        $this->attachments = $attachments;

        return $this;
    }
}
