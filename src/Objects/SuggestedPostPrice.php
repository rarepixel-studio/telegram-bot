<?php

namespace Telegram\Bot\Objects;

use Telegram\Bot\Contracts\ClientConstructibleObjectInterface;
use Telegram\Bot\Enums\SuggestedPostCurrency;
use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Class SuggestedPostPrice.
 *
 * Describes the price of a suggested post.
 */
class SuggestedPostPrice extends BaseObject implements ClientConstructibleObjectInterface
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Create a new instance from array data.
     *
     * @param  array<string, mixed>  $data
     */
    public static function fromArray(array $data): static
    {
        return new static($data);
    }

    /**
     * Create a SuggestedPostPrice instance.
     *
     * @param  array<string, mixed>  $items
     * @param  mixed  ...$args
     */
    public static function make($items = [], ...$args): self
    {
        if (is_array($items)) {
            return new self($items);
        }

        return new self([]);
    }

    /**
     * Set the currency for the suggested post price.
     *
     * @throws TelegramValidationException
     */
    public function withCurrency(SuggestedPostCurrency|string $currency): self
    {
        if (is_string($currency)) {
            try {
                $currency = SuggestedPostCurrency::from($currency);
            } catch (\ValueError $exception) {
                throw new TelegramValidationException('Invalid currency provided', previous: $exception);
            }
        }

        $this->items['currency'] = $currency;

        return $this;
    }

    /**
     * Set the amount for the suggested post price.
     */
    public function withAmount(int $amount): self
    {
        $this->items['amount'] = $amount;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function validate(): void
    {
        if (! isset($this->items['currency'])) {
            throw new TelegramValidationException('currency is required');
        }

        if (! isset($this->items['amount'])) {
            throw new TelegramValidationException('amount is required');
        }

        $currency = $this->items['currency'];
        if (is_string($currency)) {
            try {
                $currency = SuggestedPostCurrency::from($currency);
            } catch (\ValueError $exception) {
                throw new TelegramValidationException('Invalid currency provided', previous: $exception);
            }
            $this->items['currency'] = $currency;
        }

        $amount = $this->items['amount'];
        if (! is_int($amount)) {
            throw new TelegramValidationException('amount must be an integer');
        }

        if ($currency === SuggestedPostCurrency::TelegramStars) {
            if ($amount < 5 || $amount > 100000) {
                throw new TelegramValidationException('amount must be between 5 and 100000 for XTR currency');
            }
        }

        if ($currency === SuggestedPostCurrency::Toncoins) {
            if ($amount < 10000000 || $amount > 10000000000000) {
                throw new TelegramValidationException('amount must be between 10000000 and 10000000000000 for TON currency');
            }
        }
    }

    /**
     * Currency in which the post will be paid.
     */
    public function getCurrency(): string
    {
        $currency = $this->items['currency'];

        return $currency instanceof SuggestedPostCurrency ? $currency->value : $currency;
    }

    /**
     * Amount of the currency in the smallest units.
     */
    public function getAmount(): int
    {
        return $this->items['amount'];
    }
}
