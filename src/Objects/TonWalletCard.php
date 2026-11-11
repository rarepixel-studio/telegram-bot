<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * A public profile card for a TON wallet.
 *
 * @link https://core.telegram.org/bots/api#tonwalletcard
 */
class TonWalletCard extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'stickers' => static fn (array $items): Collection => new Collection(array_map(TonWalletCardSticker::fromArray(...), $items)),
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
     * A decimal string in the smallest units of the currency.
     */
    public function getAmount(): string
    {
        return $this->items['amount'];
    }

    /**
     * Stickers placed on the card.
     *
     * @return Collection<int, TonWalletCardSticker>
     */
    public function getStickers(): Collection
    {
        return $this->items['stickers'];
    }

    /**
     * Address of the NFT of one of the stickers, whose colors must be used for the card background.
     */
    public function getBackgroundNftAddress(): ?string
    {
        return $this->items['background_nft_address'] ?? null;
    }
}
