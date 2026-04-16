<?php

namespace Telegram\Bot\Exceptions;

use Exception;
use Telegram\Bot\Objects\ResponseParameters;
use Telegram\Bot\TelegramResponse;

/**
 * Class TelegramResponseException.
 */
class TelegramResponseException extends TelegramSDKException
{
    /**
     * @var TelegramResponse The response that threw the exception.
     */
    protected TelegramResponse $response;

    /**
     * @var array Decoded response.
     */
    protected array $responseData;

    /**
     * Creates a TelegramResponseException.
     *
     * @param  TelegramResponse  $response  The response that threw the exception.
     */
    public function __construct(TelegramResponse $response, string $message = '', int $code = 0, ?Exception $previous = null)
    {
        $this->response = $response;
        $this->responseData = $response->getDecodedBody();

        parent::__construct($message, $code, $previous);
    }

    /**
     * A factory for creating the appropriate exception based on the response from Telegram.
     *
     * @param  TelegramResponse  $response  The response that threw the exception.
     */
    public static function create(TelegramResponse $response): TelegramResponseException
    {
        $data = $response->getDecodedBody();

        if (! isset($data['ok']) || ($data['ok'] === true && ! isset($data['result']))) {
            if ($response->getRequestException()) {
                return new TelegramMalformedResponseException($response, $response->getBody(), $response->getHttpStatusCode(), $response->getRequestException());
            }

            return new TelegramMalformedResponseException($response, $response->getBody(), $response->getHttpStatusCode());
        }

        $code = $data['error_code'] ?? -1;
        $message = $data['description'] ?? 'Unknown error from API.';

        $exception = $response->getRequestException()
            ? new static($response, $message, $code, $response->getRequestException())
            : new static($response, $message, $code);

        if (Cause::botWasBlockedOrKicked($exception)) {
            $exceptionClass = TelegramUserUnreachableException::class;

            return $response->getRequestException()
                ? new $exceptionClass($response, $message, $code, $response->getRequestException())
                : new $exceptionClass($response, $message, $code);
        }

        $exceptionClass = match ($code) {
            404 => TelegramNotFoundException::class,
            403 => static::class,
            401 => TelegramUnauthorizedException::class,
            400 => static::resolveBadRequestException($message),
            default => static::class,
        };

        if ($exceptionClass === static::class) {
            return $exception;
        }

        return $response->getRequestException()
            ? new $exceptionClass($response, $message, $code, $response->getRequestException())
            : new $exceptionClass($response, $message, $code);

    }

    /**
     * Resolve the appropriate exception class for a 400 Bad Request response.
     *
     * @return class-string<TelegramResponseException>
     */
    protected static function resolveBadRequestException(string $message): string
    {
        if (str_contains($message, 'chat not found')) {
            return TelegramChatNotFoundException::class;
        }

        if (str_contains($message, 'PARTICIPANT_ID_INVALID') || str_contains($message, 'user not found')) {
            return TelegramInvalidUserIdException::class;
        }

        return static::class;
    }

    /**
     * Checks isset and returns that or a default value.
     */
    private function get(string $key, mixed $default = null): mixed
    {
        if (isset($this->responseData[$key])) {
            return $this->responseData[$key];
        }

        return $default;
    }

    /**
     * Returns the HTTP status code.
     */
    public function getHttpStatusCode(): int
    {
        return $this->response->getHttpStatusCode();
    }

    /**
     * Returns the error type.
     */
    public function getErrorType(): string
    {
        return $this->get('type', '');
    }

    /**
     * Returns the raw response used to create the exception.
     */
    public function getRawResponse(): string
    {
        return $this->response->getBody();
    }

    /**
     * Returns the decoded response used to create the exception.
     */
    public function getResponseData(): array
    {
        return $this->responseData;
    }

    public function getResponseParameters(): ResponseParameters
    {
        return new ResponseParameters($this->get('parameters', null));
    }

    /**
     * The number of seconds to retry after, or null if should not retry.
     */
    public function retryAfter(): ?int
    {
        if ($params = $this->getResponseParameters()) {
            if ($params->getRetryAfter()) {
                return $params->getRetryAfter();
            }
        }

        return null;
    }

    /**
     * Returns the response entity used to create the exception.
     */
    public function getResponse(): TelegramResponse
    {
        return $this->response;
    }
}
