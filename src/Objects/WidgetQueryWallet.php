<?php

namespace Telegram\Bot\Objects;

/**
 * A TON wallet used in a widget query.
 *
 * @link https://core.telegram.org/bots/api#widgetquerywallet
 */
class WidgetQueryWallet extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
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
     * Hex-encoded public key of the wallet.
     */
    public function getPublicKey(): ?string
    {
        return $this->items['public_key'] ?? null;
    }

    /**
     * Base64-encoded serialized StateInit of the wallet contract.
     */
    public function getStateInit(): ?string
    {
        return $this->items['state_init'] ?? null;
    }
}
