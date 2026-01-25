<?php

namespace Telegram\Bot\Objects;

/**
 * Class ShippingOption.
 *
 * This object represents one shipping option.
 *
 * @link https://core.telegram.org/bots/api#shippingoption
 */
class ShippingOption extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'prices' => LabeledPrice::class,
        ];
    }

    /**
     * Shipping option identifier.
     */
    public function getId(): string
    {
        return $this->items['id'];
    }

    /**
     * Option title.
     */
    public function getTitle(): string
    {
        return $this->items['title'];
    }

    /**
     * List of price portions.
     *
     * @return LabeledPrice[]
     */
    public function getPrices(): array
    {
        return $this->items['prices'];
    }
}
