<?php

namespace Telegram\Bot\Objects;

/**
 * Class PassportData.
 *
 * Contains information about Telegram Passport data shared with the bot by the user.
 *
 * @link https://core.telegram.org/bots/api#passportdata
 */
class PassportData extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'data' => EncryptedPassportElement::class,
            'credentials' => EncryptedCredentials::class,
        ];
    }

    /**
     * Array with information about documents and other Telegram Passport elements that was shared with the bot.
     *
     * @return EncryptedPassportElement[]
     */
    public function getData(): array
    {
        return $this->items['data'];
    }

    /**
     * Encrypted credentials required to decrypt the data.
     */
    public function getCredentials(): EncryptedCredentials
    {
        return $this->items['credentials'];
    }
}
