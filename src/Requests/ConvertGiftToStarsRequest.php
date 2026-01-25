<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the convertGiftToStars method.
 *
 * Use this method to convert a gift to Telegram Stars.
 *
 * @link https://core.telegram.org/bots/api#convertgifttostars
 */
class ConvertGiftToStarsRequest extends TelegramApiRequest
{
    public function __construct(
        protected string $business_connection_id,
        protected string $owned_gift_id,
    ) {}

    public function getMethod(): string
    {
        return 'convertGiftToStars';
    }

    public function validate(): void
    {
        if (empty($this->business_connection_id)) {
            throw new TelegramValidationException('business_connection_id cannot be empty');
        }
        if (empty($this->owned_gift_id)) {
            throw new TelegramValidationException('owned_gift_id cannot be empty');
        }
    }

    public function buildParams(): array
    {
        return [
            'business_connection_id' => $this->business_connection_id,
            'owned_gift_id' => $this->owned_gift_id,
        ];
    }
}
