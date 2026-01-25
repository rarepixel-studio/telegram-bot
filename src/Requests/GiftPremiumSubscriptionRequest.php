<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the giftPremiumSubscription method.
 *
 * Use this method to gift a Telegram Premium subscription to a user.
 *
 * @link https://core.telegram.org/bots/api#giftpremiumsubscription
 */
class GiftPremiumSubscriptionRequest extends TelegramApiRequest
{
    /**
     * @param  int  $user_id  Unique identifier of the target user
     * @param  int  $month_count  Duration of the premium subscription in months (1, 3, 6, or 12)
     */
    public function __construct(
        protected int $user_id,
        protected int $month_count,
        protected int $star_count,
    ) {}

    public function getMethod(): string
    {
        return 'giftPremiumSubscription';
    }

    public function validate(): void
    {
        if ($this->user_id <= 0) {
            throw new TelegramValidationException('user_id must be greater than 0');
        }

        if (! in_array($this->month_count, [1, 3, 6, 12])) {
            throw new TelegramValidationException('month_count must be one of: 1, 3, 6, 12');
        }
        if ($this->star_count <= 0) {
            throw new TelegramValidationException('star_count must be greater than 0');
        }
    }

    public function buildParams(): array
    {
        return [
            'user_id' => $this->user_id,
            'month_count' => $this->month_count,
            'star_count' => $this->star_count,
        ];
    }
}
