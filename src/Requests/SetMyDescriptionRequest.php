<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the setMyDescription method.
 */
class SetMyDescriptionRequest extends TelegramApiRequest
{
    protected array $params = [];

    public function __construct() {}

    public function description(string $description): self
    {
        $this->params['description'] = $description;

        return $this;
    }

    public function languageCode(string $language_code): self
    {
        $this->params['language_code'] = $language_code;

        return $this;
    }

    public function getMethod(): string
    {
        return 'setMyDescription';
    }

    public function validate(): void
    {
        if (isset($this->params['description']) && mb_strlen($this->params['description']) > 512) {
            throw new TelegramValidationException('description must not exceed 512 characters');
        }
    }

    public function buildParams(): array
    {
        return $this->params;
    }
}
