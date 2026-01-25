<?php

namespace Telegram\Bot;

use Closure;
use Illuminate\Support\Str;
use Telegram\Bot\Contracts\ApiInterface;
use Telegram\Bot\Contracts\ClientInterface;
use Telegram\Bot\Contracts\HttpClientInterface;
use Telegram\Bot\Exceptions\TelegramSDKException;
use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\UnknownObject;

/**
 * Class Api.
 */
class Api implements ApiInterface
{
    use Traits\ApiMethodWrappers;
    use Traits\HasHttpRequests;

    /**
     * @var string Version number of the Telegram Bot PHP SDK.
     */
    const VERSION = '3.0.0';

    /**
     * @var string The name of the environment variable that contains the Telegram Bot API Access Token.
     */
    const BOT_TOKEN_ENV_NAME = 'TELEGRAM_BOT_TOKEN';

    /**
     * @var ClientInterface The Telegram client service.
     */
    protected ClientInterface $client;

    /**
     * @var ?string Telegram Bot API Access Token.
     */
    protected ?string $accessToken = null;

    /**
     * @var TelegramResponse|null Stores the last request made to Telegram Bot API.
     */
    protected ?TelegramResponse $lastResponse = null;

    /**
     * @var bool Indicates if the request to Telegram will be asynchronous (non-blocking).
     */
    protected bool $isAsyncRequest = false;

    /**
     * The array of waiting async responses.
     *
     * @var TelegramResponse[]
     */
    protected array $waitingResponses = [];

    /**
     * Timeout of the request in seconds.
     */
    protected int $timeOut = 60;

    /**
     * Connection timeout of the request in seconds.
     */
    protected int $connectTimeOut = 10;

    /**
     * The event that will be fired on sending a request.
     *
     * @var null|Closure function(TelegramRequest)
     */
    protected ?Closure $onSending = null;

    /**
     * The fulfillment handler to be called after each successful API call.
     *
     * @var null|Closure function(TelegramResponse, float)
     */
    protected ?Closure $onFulfilled = null;

    /**
     * The rejection handler to be called after each failed API call.
     *
     * @var null|Closure function(TelegramResponse, float)
     */
    protected ?Closure $onRejected = null;


    /**
     * Instantiates a new Telegram super-class object.
     *
     *
     * @param  string|null  $token  The Telegram Bot API Access Token.
     * @param  bool  $async  (Optional) Indicates if the request to Telegram
     *                       will be asynchronous (non-blocking).
     * @param  HttpClientInterface|null  $httpClientHandler  (Optional) Custom HTTP Client Handler.
     *
     * @throws TelegramValidationException|TelegramSDKException
     */
    public function __construct(?string $token = null, bool $async = false, ?HttpClientInterface $httpClientHandler = null, ?ClientInterface $client = null)
    {
        $token = $token ?? getenv(static::BOT_TOKEN_ENV_NAME);

        if (! $token) {
            throw new TelegramSDKException('Required "token" not supplied in config and could not find fallback environment variable "'.static::BOT_TOKEN_ENV_NAME.'"');
        }

        $this->setAccessToken($token);

        $this->client = $client ?? new TelegramClient($httpClientHandler);

        if (isset($async)) {
            $this->setAsyncRequest($async);
        }
    }

    /**
     * Wait for the responses of async requests and empty the waitingResponses array.
     */
    public function __destruct()
    {
        $this->asyncWait();
    }

    /**
     * Returns the Telegram client service.
     */
    public function getClient(): ClientInterface
    {
        return $this->client;
    }

    /**
     * Returns Telegram Bot API Access Token.
     */
    public function getAccessToken(): string
    {
        return $this->accessToken;
    }

    /**
     * Returns the last response returned from API request.
     */
    public function getLastResponse(): ?TelegramResponse
    {
        return $this->lastResponse;
    }

    /**
     * Sets the bot access token to use with API requests.
     *
     * @param  string  $accessToken  The bot access token to save.
     * @return $this
     */
    public function setAccessToken(string $accessToken): self
    {
        $this->accessToken = $accessToken;

        return $this;
    }

    /**
     * Wait for the responses of async requests and empty the waitingResponses array.
     *
     * @return TelegramResponse[]
     */
    public function asyncWait(): array
    {
        $waiting = $this->waitingResponses;

        $this->waitingResponses = [];

        foreach ($waiting as $response) {
            try {
                $response->wait();
            } catch (\Exception $e) {
                //
            }
        }

        return $waiting;
    }

    /**
     * Make this request asynchronous (non-blocking).
     *
     *
     * @return $this
     */
    public function setAsyncRequest(bool $isAsyncRequest): self
    {
        $this->isAsyncRequest = $isAsyncRequest;

        if (! $this->isAsyncRequest()) {
            $this->asyncWait();
        }

        return $this;
    }

    /**
     * Check if this is an asynchronous request (non-blocking).
     */
    public function isAsyncRequest(): bool
    {
        return $this->isAsyncRequest;
    }


    /**
     * Magic method to process any "get" requests.
     *
     * @throws TelegramSDKException
     */
    public function __call(string $method, array $arguments): bool|TelegramResponse|UnknownObject
    {
        $action = substr($method, 0, 3);
        if ($action === 'get') {
            $class_name = Str::studly(substr($method, 3));
            $class = 'Telegram\Bot\Objects\\'.$class_name;
            $response = $this->post($method, $arguments[0] ?: []);

            if (class_exists($class)) {
                return new $class($response->getDecodedBody());
            }

            return $response;
        }
        $response = $this->post($method, $arguments[0]);

        return new UnknownObject($response->getDecodedBody());
    }

    public function getTimeOut(): int
    {
        return $this->timeOut;
    }

    /**
     * @return $this
     */
    public function setTimeOut(int $timeOut): self
    {
        $this->timeOut = $timeOut;

        return $this;
    }

    public function getConnectTimeOut(): int
    {
        return $this->connectTimeOut;
    }

    /**
     * @return $this
     */
    public function setConnectTimeOut(int $connectTimeOut): self
    {
        $this->connectTimeOut = $connectTimeOut;

        return $this;
    }

    /**
     * Clear or set a sending handler on the subsequent API requests.
     *
     * <code>
     * $api->onSending(function (TelegramRequest $request) {
     *     //Profile.
     *     //Throw an exception if expecting too many request.
     *     //...
     * })
     * </code>
     *
     * @param  null|Closure  $onSending  function(TelegramRequest $request)
     * @return $this
     */
    public function onSending(?Closure $onSending = null): self
    {
        $this->onSending = $onSending;

        return $this;
    }

    /**
     * Clear or set a fulfillment handler on the subsequent API requests.
     *
     * <code>
     * $api->onFulfilled(function (TelegramResponse $response, $elapsedTime) {
     *     //Profile the api delay
     *     //...
     * })
     * </code>
     *
     * @param  null|Closure  $onFulfilled  function(TelegramResponse $response, float $elapsedTime)
     * @return $this
     */
    public function onFulfilled(?Closure $onFulfilled = null): self
    {
        $this->onFulfilled = $onFulfilled;

        return $this;
    }

    /**
     * Clear or set a rejection handler on the subsequent API requests.
     *
     * <code>
     * $api->onRejected(function (TelegramResponse $response, $elapsedTime) {
     *     //Profile the api delay
     *     //Log the API exception
     *     //...
     * })
     * </code>
     *
     * @param  null|Closure  $onRejected  function(TelegramResponse $response, float $elapsedTime)
     * @return $this
     */
    public function onRejected(?Closure $onRejected = null): self
    {
        $this->onRejected = $onRejected;

        return $this;
    }
}
