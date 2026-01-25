<?php

namespace Telegram\Bot\Objects;

/**
 * Class BusinessGiftSettings.
 *
 * @link https://core.telegram.org/bots/api#businessgiftsettings
 *
 * @property bool $gift_stickers_visible  True, if gifts are visible on the business account's profile
 */
class BusinessGiftSettings extends BaseObject
{
    public function relations(): array
    {
        return [];
    }
}
