<?php

namespace Telegram\Bot\Objects;

use Telegram\Bot\Contracts\ClientConstructibleObjectInterface;
use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Class SuggestedPostParameters.
 *
 * Contains parameters of a post that is being suggested by the bot.
 */
class SuggestedPostParameters extends BaseObject implements ClientConstructibleObjectInterface
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'price' => SuggestedPostPrice::class,
        ];
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
     * Create a SuggestedPostParameters instance.
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
     * Set the suggested post price.
     *
     * @param  SuggestedPostPrice|array<string, mixed>|null  $price
     */
    public function withPrice(SuggestedPostPrice|array|null $price): self
    {
        $this->items['price'] = $price;

        return $this;
    }

    /**
     * Set the proposed send date (Unix time).
     */
    public function withSendDate(?int $sendDate): self
    {
        $this->items['send_date'] = $sendDate;

        return $this;
    }

    /**
     * {@inheritDoc}
     */
    public function validate(): void
    {
        if (isset($this->items['price'])) {
            $price = $this->items['price'];
            if (is_array($price)) {
                $price = SuggestedPostPrice::fromArray($price);
                $this->items['price'] = $price;
            }

            if ($price instanceof SuggestedPostPrice) {
                $price->validate();
            }
        }

        if (isset($this->items['send_date'])) {
            $sendDate = $this->items['send_date'];
            if (! is_int($sendDate)) {
                throw new TelegramValidationException('send_date must be an integer');
            }

            $min = time() + 300;
            $max = time() + 2678400;
            if ($sendDate < $min || $sendDate > $max) {
                throw new TelegramValidationException('send_date must be between 300 and 2678400 seconds in the future');
            }
        }
    }

    /**
     * Proposed price for the post.
     */
    public function getPrice(): ?SuggestedPostPrice
    {
        return $this->items['price'] ?? null;
    }

    /**
     * Proposed send date.
     */
    public function getSendDate(): ?int
    {
        return $this->items['send_date'] ?? null;
    }
}
