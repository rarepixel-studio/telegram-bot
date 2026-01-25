<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the setMyName method.
 */
class SetMyNameRequest extends TelegramApiRequest
{
    protected array $params = [];

    public function __construct() {}

    public function name(string $name): self
    {
        $this->params['name'] = $name;

        return $this;
    }

    public function languageCode(string $language_code): self
    {
        $this->params['language_code'] = $language_code;

        return $this;
    }

    public function getMethod(): string
    {
        return 'setMyName';
    }

    public function validate(): void
    {
        if (isset($this->params['name']) && mb_strlen($this->params['name']) > 64) {
            throw new TelegramValidationException('name must not exceed 64 characters');
        }
    }

    public function buildParams(): array
    {
        return $this->params;
    }
}
