<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the getMyDescription method.
 */
class GetMyDescriptionRequest extends TelegramApiRequest
{
    protected array $params = [];

    public function __construct() {}

    public function languageCode(string $language_code): self
    {
        $this->params['language_code'] = $language_code;

        return $this;
    }

    public function getMethod(): string
    {
        return 'getMyDescription';
    }

    public function validate(): void {}

    public function buildParams(): array
    {
        return $this->params;
    }
}
