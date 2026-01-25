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
    /**
     * @param  int  $user_id  Unique identifier of the user
     * @param  string  $gift_id  Identifier of the gift
     * @param  int|string  $recipient_id  Unique identifier of the recipient
     */
    public function __construct(
        protected int $user_id,
        protected string $gift_id,
        protected int|string $recipient_id,
    ) {}

    protected array $params = [];

    // Assuming no other params for now based on typical transfer methods, but keeping extensible

    public function getMethod(): string
    {
        return 'transferGift';
    }

    public function validate(): void
    {
        if ($this->user_id <= 0) {
            throw new TelegramValidationException('user_id must be greater than 0');
        }
        if (empty($this->gift_id)) {
            throw new TelegramValidationException('gift_id cannot be empty');
        }
    }

    public function buildParams(): array
    {
        return [
            'user_id' => $this->user_id,
            'gift_id' => $this->gift_id,
            'recipient_id' => $this->recipient_id,
        ] + $this->params;
    }
}
