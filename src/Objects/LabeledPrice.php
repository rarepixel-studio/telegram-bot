<?php

namespace Telegram\Bot\Objects;

/**
 * Class LabeledPrice.
 *
 * This object represents a portion of the price for goods or services.
 *
 * @link https://core.telegram.org/bots/api#labeledprice
 */
class LabeledPrice extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Portion label.
     */
    public function getLabel(): string
    {
        return $this->items['label'];
    }

    /**
     * Price of the product in the smallest units of the currency.
     */
    public function getAmount(): int
    {
        return $this->items['amount'];
    }
}
