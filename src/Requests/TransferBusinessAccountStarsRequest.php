<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the transferBusinessAccountStars method.
 *
 * Use this method to transfer Telegram Stars from the business connection to another account.
 *
 * @link https://core.telegram.org/bots/api#transferbusinessaccountstars
 */
class TransferBusinessAccountStarsRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  string  $business_connection_id  Unique identifier of the business connection
     * @param  int  $amount  Number of Telegram Stars to be transferred
     * @param  string  $transfer_id  Unique identifier of the transfer
     * @param  int|string  $recipient  Unique identifier for the chat or username of the recipient
     */
    public function __construct(
        protected string $business_connection_id,
        protected int $amount,
        protected string $transfer_id,
        protected int|string $recipient,
    ) {}

    public function allowedForPayment(bool $allowed_for_payment): self
    {
        $this->params['allowed_for_payment'] = $allowed_for_payment;

        return $this;
    }

    public function getMethod(): string
    {
        return 'transferBusinessAccountStars';
    }

    public function validate(): void
    {
        if (empty($this->business_connection_id)) {
            throw new TelegramValidationException('business_connection_id cannot be empty');
        }
        if ($this->amount <= 0) {
            throw new TelegramValidationException('amount must be greater than 0');
        }
        if (empty($this->transfer_id)) {
            throw new TelegramValidationException('transfer_id cannot be empty');
        }
    }

    public function buildParams(): array
    {
        return [
            'business_connection_id' => $this->business_connection_id,
            'amount' => $this->amount,
            'transfer_id' => $this->transfer_id,
            'recipient' => $this->recipient,
        ] + $this->params;
    }
}
