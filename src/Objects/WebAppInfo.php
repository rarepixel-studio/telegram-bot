<?php

namespace Telegram\Bot\Objects;

use Telegram\Bot\Contracts\ClientConstructibleObjectInterface;
use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Class WebAppInfo.
 *
 * Describes a Web App.
 */
class WebAppInfo extends BaseObject implements ClientConstructibleObjectInterface
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Create a new instance from array data.
     *
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): static
    {
        return new static($data);
    }

    /**
     * Create a WebAppInfo instance.
     *
     * @param  array<string, mixed>|string  $items
     */
    public static function make($items = []): self
    {
        if (is_string($items)) {
            return new self(['url' => $items]);
        }

        if (is_array($items)) {
            return new self($items);
        }

        return new self([]);
    }

    /**
     * Set the web app URL.
     */
    public function withUrl(string $url): self
    {
        $this->items['url'] = $url;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function validate(): void
    {
        if (! isset($this->items['url'])) {
            throw new TelegramValidationException('url is required');
        }

        if (filter_var($this->items['url'], FILTER_VALIDATE_URL) === false) {
            throw new TelegramValidationException('Invalid URL provided');
        }

        if (parse_url($this->items['url'], PHP_URL_SCHEME) !== 'https') {
            throw new TelegramValidationException('Invalid URL, should be a HTTPS url.');
        }
    }

    /**
     * An HTTPS URL of a Web App to be opened with additional data.
     */
    public function getUrl(): string
    {
        return $this->items['url'];
    }
}
