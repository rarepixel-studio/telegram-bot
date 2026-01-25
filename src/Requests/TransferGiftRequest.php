<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the transferGift method.
 *
 * Use this method to transfer a gift.
 *
 * @link https://core.telegram.org/bots/api#transfergift
 */
class TransferGiftRequest extends TelegramApiRequest
{
    public function __construct(
        protected string $business_connection_id,
        protected string $owned_gift_id,
        protected int|string $new_owner_chat_id,
    ) {}

    protected array $params = [];

    // Assuming no other params for now based on typical transfer methods, but keeping extensible

    public function getMethod(): string
    {
        return 'transferGift';
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
            'new_owner_chat_id' => $this->new_owner_chat_id,
        ] + $this->params;
    }
}
