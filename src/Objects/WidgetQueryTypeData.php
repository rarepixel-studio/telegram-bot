<?php

namespace Telegram\Bot\Objects;

/**
 * Widget data sent to the bot.
 *
 * @link https://core.telegram.org/bots/api#widgetquerytypedata
 */
class WidgetQueryTypeData extends WidgetQueryType
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'wallet_card' => TonWalletCard::class,
        ];
    }

    /**
     * TON wallet card of the user who sent the query, if it was sent to the bot along with the query.
     */
    public function getWalletCard(): ?TonWalletCard
    {
        return $this->items['wallet_card'] ?? null;
    }
}
