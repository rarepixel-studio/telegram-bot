<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\BusinessGiftSettings;

/**
 * Request object for the setBusinessAccountGiftSettings method.
 *
 * Use this method to change the gift settings of the business connection.
 *
 * @link https://core.telegram.org/bots/api#setbusinessaccountgiftsettings
 */
class SetBusinessAccountGiftSettingsRequest extends TelegramApiRequest
{
    /**
     * @param  string  $business_connection_id  Unique identifier of the business connection
     * @param  BusinessGiftSettings  $gift_settings  New gift settings
     */
    public function __construct(
        protected string $business_connection_id,
        protected BusinessGiftSettings $gift_settings,
    ) {}

    public function getMethod(): string
    {
        return 'setBusinessAccountGiftSettings';
    }

    public function validate(): void
    {
        if (empty($this->business_connection_id)) {
            throw new TelegramValidationException('business_connection_id cannot be empty');
        }
    }

    public function buildParams(): array
    {
        return [
            'business_connection_id' => $this->business_connection_id,
            'gift_settings' => $this->gift_settings,
        ];
    }
}
