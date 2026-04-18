<?php

namespace Telegram\Bot\Objects;

use Telegram\Bot\Contracts\ClientConstructibleObjectInterface;
use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Class LoginUrl.
 *
 * This object represents a parameter of the inline keyboard button used to automatically authorize a user.
 */
class LoginUrl extends BaseObject implements ClientConstructibleObjectInterface
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
     * Create a LoginUrl instance.
     *
     * @param  array<string, mixed>|string  $items
     * @param  mixed  ...$args
     */
    public static function make($items = [], ...$args): self
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
     * Set the URL.
     */
    public function withUrl(string $url): self
    {
        $this->items['url'] = $url;

        return $this;
    }

    /**
     * Set the forward text.
     */
    public function withForwardText(?string $forwardText): self
    {
        $this->items['forward_text'] = $forwardText;

        return $this;
    }

    /**
     * Set the bot username.
     */
    public function withBotUsername(?string $botUsername): self
    {
        $this->items['bot_username'] = $botUsername;

        return $this;
    }

    /**
     * Set whether to request write access.
     */
    public function withRequestWriteAccess(?bool $requestWriteAccess): self
    {
        $this->items['request_write_access'] = $requestWriteAccess;

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
     * URL to be opened.
     */
    public function getUrl(): string
    {
        return $this->items['url'];
    }

    /**
     * New text of the button in forwarded messages.
     */
    public function getForwardText(): ?string
    {
        return $this->items['forward_text'] ?? null;
    }

    /**
     * Username of a bot used for user authorization.
     */
    public function getBotUsername(): ?string
    {
        return $this->items['bot_username'] ?? null;
    }

    /**
     * True if requesting write access.
     */
    public function getRequestWriteAccess(): ?bool
    {
        return $this->items['request_write_access'] ?? null;
    }
}
