<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Get a unique gift by its name.
 *
 * @link https://core.telegram.org/bots/api#getuniquegift
 */
class GetUniqueGiftRequest extends TelegramApiRequest
{
    /** @var array<string, mixed> Additional request parameters. */
    protected array $params = [];

    /**
     * @param  string  $name  Unique gift name
     */
    public function __construct(
        protected string $name,
    ) {}

    /**
     * Build a request from Telegram parameter names.
     *
     * @param  array<string, mixed>  $params  Telegram request parameters
     * @return self The request object
     *
     * @throws TelegramValidationException
     */
    public static function fromArray(array $params): self
    {
        $name = $params['name'] ?? null;
        if (! is_string($name)) {
            throw new TelegramValidationException('name is required and must be a string');
        }

        $request = new self($name);
        $request->params = array_diff_key($params, array_flip(['name']));

        return $request;
    }

    /**
     * {@inheritdoc}
     */
    public function getMethod(): string
    {
        return 'getUniqueGift';
    }

    /**
     * {@inheritdoc}
     *
     * @throws TelegramValidationException
     */
    public function validate(): void
    {
        if ($this->name === '') {
            throw new TelegramValidationException('name cannot be empty');
        }
    }

    /**
     * {@inheritdoc}
     */
    protected function buildParams(): array
    {
        return [
            'name' => $this->name,
        ] + $this->params;
    }
}
