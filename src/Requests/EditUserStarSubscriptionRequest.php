<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the editUserStarSubscription method.
 *
 * Use this method to check the status of a user's subscription or edit it.
 *
 * @link https://core.telegram.org/bots/api#edituserstarsubscription
 */
class EditUserStarSubscriptionRequest extends TelegramApiRequest
{
    /**
     * @param  int  $user_id  Identifier of the user whose subscription will be edited
     * @param  string  $telegram_payment_charge_id  Telegram payment identifier for the subscription
     * @param  bool  $is_canceled  Pass True to cancel the subscription
     */
    public function __construct(
        protected int $user_id,
        protected string $telegram_payment_charge_id,
        protected bool $is_canceled,
    ) {}

    public function getMethod(): string
    {
        return 'editUserStarSubscription';
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
            'is_canceled' => $this->is_canceled,
        ];
    }
}
