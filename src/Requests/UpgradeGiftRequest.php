<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the upgradeGift method.
 *
 * Use this method to upgrade a gift.
 *
 * @link https://core.telegram.org/bots/api#upgradegift
 */
class UpgradeGiftRequest extends TelegramApiRequest
{
    /**
     * @param  int  $user_id  Unique identifier of the user
     * @param  string  $gift_id  Identifier of the gift
     */
    public function __construct(
        protected int $user_id,
        protected string $gift_id,
    ) {}

    public function getMethod(): string
    {
        return 'upgradeGift';
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
        ];
    }
}
