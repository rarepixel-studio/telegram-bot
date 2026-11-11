<?php

namespace Telegram\Bot\Objects;

/**
 * A transaction initiated by the sender’s TON wallet.
 *
 * @link https://core.telegram.org/bots/api#widgetquerytypesenttransaction
 */
class WidgetQueryTypeSentTransaction extends WidgetQueryType
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'wallet' => WidgetQueryWallet::class,
        ];
    }

    /**
     * The wallet from which the transaction was sent.
     */
    public function getWallet(): WidgetQueryWallet
    {
        return $this->items['wallet'];
    }

    /**
     * Value of msg_hash of the transaction.
     */
    public function getMsgHash(): string
    {
        return $this->items['msg_hash'];
    }
}
