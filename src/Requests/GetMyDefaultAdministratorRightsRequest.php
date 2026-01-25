<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the getMyDefaultAdministratorRights method.
 */
class GetMyDefaultAdministratorRightsRequest extends TelegramApiRequest
{
    protected array $params = [];

    public function __construct() {}

    public function forChannels(bool $for_channels): self
    {
        $this->params['for_channels'] = $for_channels;

        return $this;
    }

    public function getMethod(): string
    {
        return 'getMyDefaultAdministratorRights';
    }

    public function validate(): void {}

    public function buildParams(): array
    {
        return $this->params;
    }
}
