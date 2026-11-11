<?php

namespace Telegram\Bot\Objects;

/**
 * An NFT sticker displayed on a TON wallet card.
 *
 * @link https://core.telegram.org/bots/api#tonwalletcardsticker
 */
class TonWalletCardSticker extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'position' => AreaPosition::class,
            'nft' => TonNft::class,
        ];
    }

    /**
     * The position of the sticker on the card.
     */
    public function getPosition(): AreaPosition
    {
        return $this->items['position'];
    }

    /**
     * The NFT displayed as a sticker.
     */
    public function getNft(): TonNft
    {
        return $this->items['nft'];
    }
}
