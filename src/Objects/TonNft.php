<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * An NFT on the TON blockchain.
 *
 * @link https://core.telegram.org/bots/api#tonnft
 */
class TonNft extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'attributes' => static fn (array $items): Collection => new Collection(array_map(TonNftAttribute::fromArray(...), $items)),
            'gift' => UniqueGift::class,
        ];
    }

    /**
     * The TON blockchain address.
     */
    public function getAddress(): string
    {
        return $this->items['address'];
    }

    /**
     * Address of the collection to which the NFT belongs.
     */
    public function getCollectionAddress(): ?string
    {
        return $this->items['collection_address'] ?? null;
    }

    /**
     * The index in the collection, as a decimal string.
     */
    public function getIndex(): string
    {
        return $this->items['index'];
    }

    /**
     * Name of the NFT.
     */
    public function getName(): string
    {
        return $this->items['name'];
    }

    /**
     * Description of the NFT.
     */
    public function getDescription(): string
    {
        return $this->items['description'];
    }

    /**
     * Attributes of the NFT.
     *
     * @return Collection<int, TonNftAttribute>|null
     */
    public function getAttributes(): ?Collection
    {
        return $this->items['attributes'] ?? null;
    }

    /**
     * The associated unique gift.
     */
    public function getGift(): ?UniqueGift
    {
        return $this->items['gift'] ?? null;
    }
}
