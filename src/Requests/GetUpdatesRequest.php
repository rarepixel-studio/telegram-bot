<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the getUpdates method.
 *
 * @link https://core.telegram.org/bots/api#getupdates
 */
class GetUpdatesRequest extends TelegramApiRequest
{
    protected ?int $offset = null;

    protected ?int $limit = null;

    protected ?int $timeout = null;

    /** @var string[]|null */
    protected ?array $allowedUpdates = null;

    /**
     * {@inheritDoc}
     */
    public function getMethod(): string
    {
        return 'getUpdates';
    }

    /**
     * Set the update offset.
     *
     * @param  int  $offset  Identifier of the first update to be returned
     * @return $this
     */
    public function setOffset(int $offset): self
    {
        $this->offset = $offset;

        return $this;
    }

    /**
     * Set the limit of updates to retrieve.
     *
     * @param  int  $limit  Number of updates (1-100)
     * @return $this
     */
    public function setLimit(int $limit): self
    {
        $this->limit = $limit;

        return $this;
    }

    /**
     * Set the timeout for long polling.
     *
     * @param  int  $timeout  Timeout in seconds
     * @return $this
     */
    public function setTimeout(int $timeout): self
    {
        $this->timeout = $timeout;

        return $this;
    }

    /**
     * Set allowed update types.
     *
     * @param  string[]  $allowedUpdates  List of update types to receive
     * @return $this
     */
    public function setAllowedUpdates(array $allowedUpdates): self
    {
        $this->allowedUpdates = $allowedUpdates;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function validate(): void
    {
        if ($this->limit !== null && ($this->limit < 1 || $this->limit > 100)) {
            throw new TelegramValidationException('Limit must be between 1 and 100');
        }

        if ($this->timeout !== null && $this->timeout < 0) {
            throw new TelegramValidationException('Timeout must be non-negative');
        }
    }

    /**
     * {@inheritDoc}
     */
    protected function buildParams(): array
    {
        return [
            'offset' => $this->offset,
            'limit' => $this->limit,
            'timeout' => $this->timeout,
            'allowed_updates' => $this->allowedUpdates,
        ];
    }
}
