<?php

namespace Telegram\Bot\Objects;

/**
 * Data signed by the sender’s TON wallet.
 *
 * @link https://core.telegram.org/bots/api#widgetquerytypesigndata
 */
class WidgetQueryTypeSignData extends WidgetQueryType
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
     * The wallet that signed the data.
     */
    public function getWallet(): WidgetQueryWallet
    {
        return $this->items['wallet'];
    }

    /**
     * JSON-serialized signed data.
     */
    public function getSignData(): string
    {
        return $this->items['sign_data'];
    }
}
