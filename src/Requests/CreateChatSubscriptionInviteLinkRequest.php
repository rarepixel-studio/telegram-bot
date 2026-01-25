<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the createChatSubscriptionInviteLink method.
 *
 * Use this method to create a subscription invite link for a channel chat.
 *
 * @link https://core.telegram.org/bots/api#createchatsubscriptioninvitelink
 */
class CreateChatSubscriptionInviteLinkRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target channel chat
     * @param  int  $subscription_period  The number of seconds the subscription will be active for before the next payment
     * @param  int  $subscription_price  The amount of Telegram Stars a user must pay initially and after each subsequent subscription period
     */
    public function __construct(
        protected int|string $chat_id,
        protected int $subscription_period,
        protected int $subscription_price,
    ) {}

    /**
     * Invite link name; 0-32 characters.
     */
    public function name(string $name): self
    {
        $this->params['name'] = $name;

        return $this;
    }

    public function getMethod(): string
    {
        return 'createChatSubscriptionInviteLink';
    }

    public function validate(): void
    {
        if ($this->subscription_period <= 0) {
            throw new TelegramValidationException('subscription_period must be greater than 0');
        }

        if ($this->subscription_price <= 0) {
            throw new TelegramValidationException('subscription_price must be greater than 0');
        }

        if (isset($this->params['name'])) {
            $nameLength = mb_strlen($this->params['name']);
            if ($nameLength > 32) {
                throw new TelegramValidationException('name must not exceed 32 characters');
            }
        }
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'subscription_period' => $this->subscription_period,
            'subscription_price' => $this->subscription_price,
        ] + $this->params;
    }
}
