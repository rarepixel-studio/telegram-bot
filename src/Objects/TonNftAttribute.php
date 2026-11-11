<?php

namespace Telegram\Bot\Objects;

/**
 * An attribute of a TON NFT.
 *
 * @link https://core.telegram.org/bots/api#tonnftattribute
 */
class TonNftAttribute extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Trait type of the attribute.
     */
    public function getTraitType(): string
    {
        return $this->items['trait_type'];
    }

    /**
     * Value of the attribute.
     */
    public function getValue(): string
    {
        return $this->items['value'];
    }
}
