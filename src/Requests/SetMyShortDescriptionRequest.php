<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the setMyShortDescription method.
 */
class SetMyShortDescriptionRequest extends TelegramApiRequest
{
    protected array $params = [];

    public function __construct() {}

    public function shortDescription(string $short_description): self
    {
        $this->params['short_description'] = $short_description;

        return $this;
    }

    public function languageCode(string $language_code): self
    {
        $this->params['language_code'] = $language_code;

        return $this;
    }

    public function getMethod(): string
    {
        return 'setMyShortDescription';
    }

    public function validate(): void
    {
        if (isset($this->params['short_description']) && mb_strlen($this->params['short_description']) > 120) {
            throw new TelegramValidationException('short_description must not exceed 120 characters');
        }
    }

    public function buildParams(): array
    {
        return $this->params;
    }
}
