<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the refundStarPayment method.
 *
 * Use this method to refund a successful payment in Telegram Stars.
 *
 * @link https://core.telegram.org/bots/api#refundstarpayment
 */
class RefundStarPaymentRequest extends TelegramApiRequest
{
    /**
     * @param  int  $user_id  Identifier of the user whose payment will be refunded
     * @param  string  $telegram_payment_charge_id  Telegram payment identifier
     */
    public function __construct(
        protected int $user_id,
        protected string $telegram_payment_charge_id,
    ) {}

    public function getMethod(): string
    {
        return 'refundStarPayment';
    }

    public function validate(): void
    {
        if ($this->user_id <= 0) {
            throw new TelegramValidationException('user_id must be greater than 0');
        }
        if (empty($this->telegram_payment_charge_id)) {
            throw new TelegramValidationException('telegram_payment_charge_id cannot be empty');
        }
    }

    public function buildParams(): array
    {
        return [
            'user_id' => $this->user_id,
            'telegram_payment_charge_id' => $this->telegram_payment_charge_id,
        ];
    }
}
