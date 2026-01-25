<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;
use Telegram\Bot\Objects\AcceptedGiftTypes;

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
     * @param  bool  $show_gift_button  True, if a button for sending a gift must always be shown
     * @param  AcceptedGiftTypes|array  $accepted_gift_types  Types of gifts accepted by the business account
     */
    public function __construct(
        protected string $business_connection_id,
        protected bool $show_gift_button,
        protected AcceptedGiftTypes|array $accepted_gift_types,
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

        if (! is_bool($this->show_gift_button)) {
            throw new TelegramValidationException('show_gift_button must be a boolean');
        }
    }

    public function buildParams(): array
    {
        return [
            'business_connection_id' => $this->business_connection_id,
            'show_gift_button' => $this->show_gift_button,
            'accepted_gift_types' => $this->accepted_gift_types,
        ];
    }
}
