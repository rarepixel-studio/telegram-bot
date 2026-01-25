<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the setMyDefaultAdministratorRights method.
 */
class SetMyDefaultAdministratorRightsRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'rights',
    ];

    protected array $params = [];

    public function __construct() {}

    public function rights(array $rights): self
    {
        $this->params['rights'] = $rights;

        return $this;
    }

    public function forChannels(bool $for_channels): self
    {
        $this->params['for_channels'] = $for_channels;

        return $this;
    }

    public function getMethod(): string
    {
        return 'setMyDefaultAdministratorRights';
    }

    public function validate(): void {}

    public function buildParams(): array
    {
        return $this->params;
    }
}
