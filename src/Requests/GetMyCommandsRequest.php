<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the getMyCommands method.
 */
class GetMyCommandsRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'scope',
    ];

    protected array $params = [];

    public function __construct() {}

    public function scope(array $scope): self
    {
        $this->params['scope'] = $scope;

        return $this;
    }

    public function languageCode(string $language_code): self
    {
        $this->params['language_code'] = $language_code;

        return $this;
    }

    public function getMethod(): string
    {
        return 'getMyCommands';
    }

    public function validate(): void {}

    public function buildParams(): array
    {
        return $this->params;
    }
}
