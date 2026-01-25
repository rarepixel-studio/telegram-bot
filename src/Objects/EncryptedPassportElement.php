<?php

namespace Telegram\Bot\Objects;

/**
 * Class EncryptedPassportElement.
 *
 * Contains information about documents or other Telegram Passport elements shared with the bot by the user.
 *
 * @link https://core.telegram.org/bots/api#encryptedpassportelement
 */
class EncryptedPassportElement extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'front_side' => PassportFile::class,
            'reverse_side' => PassportFile::class,
            'selfie' => PassportFile::class,
            'translation' => PassportFile::class,
            'files' => PassportFile::class,
        ];
    }

    /**
     * Element type. One of 'personal_details', 'passport', 'driver_license', 'identity_card', 'internal_passport', 'address', 'utility_bill', 'bank_statement', 'rental_agreement', 'passport_registration', 'temporary_registration', 'phone_number', 'email'.
     */
    public function getType(): string
    {
        return $this->items['type'];
    }

    /**
     * (Optional). Base64-encoded encrypted Telegram Passport element data provided by the user, available for 'personal_details', 'passport', 'driver_license', 'identity_card', 'internal_passport' and 'address' types. Can be decoded and decrypted using the accompanying EncryptedCredentials.
     */
    public function getData(): ?string
    {
        return $this->items['data'] ?? null;
    }

    /**
     * (Optional). User's verified phone number, available only for 'phone_number' type.
     */
    public function getPhoneNumber(): ?string
    {
        return $this->items['phone_number'] ?? null;
    }

    /**
     * (Optional). User's verified email address, available only for 'email' type.
     */
    public function getEmail(): ?string
    {
        return $this->items['email'] ?? null;
    }

    /**
     * (Optional). Array of encrypted files with documents provided by the user, available for 'utility_bill', 'bank_statement', 'rental_agreement', 'passport_registration' and 'temporary_registration' types. Files can be decrypted and verified using the accompanying EncryptedCredentials.
     *
     * @return PassportFile[]|null
     */
    public function getFiles(): ?array
    {
        return $this->items['files'] ?? null;
    }

    /**
     * (Optional). Encrypted file with the front side of the document, provided by the user. Available for 'passport', 'driver_license', 'identity_card' and 'internal_passport'. The file can be decrypted and verified using the accompanying EncryptedCredentials.
     */
    public function getFrontSide(): ?PassportFile
    {
        return $this->items['front_side'] ?? null;
    }

    /**
     * (Optional). Encrypted file with the reverse side of the document, provided by the user. Available for 'driver_license' and 'identity_card'. The file can be decrypted and verified using the accompanying EncryptedCredentials.
     */
    public function getReverseSide(): ?PassportFile
    {
        return $this->items['reverse_side'] ?? null;
    }

    /**
     * (Optional). Encrypted file with the selfie of the user holding a document, provided by the user; available for 'passport', 'driver_license', 'identity_card' and 'internal_passport'. The file can be decrypted and verified using the accompanying EncryptedCredentials.
     */
    public function getSelfie(): ?PassportFile
    {
        return $this->items['selfie'] ?? null;
    }

    /**
     * (Optional). Array of encrypted files with translated versions of documents provided by the user. Available if requested for 'passport', 'driver_license', 'identity_card', 'internal_passport', 'utility_bill', 'bank_statement', 'rental_agreement', 'passport_registration' and 'temporary_registration' types. Files can be decrypted and verified using the accompanying EncryptedCredentials.
     *
     * @return PassportFile[]|null
     */
    public function getTranslation(): ?array
    {
        return $this->items['translation'] ?? null;
    }

    /**
     * (Optional). Base64-encoded element hash for using in PassportElementErrorUnspecified.
     */
    public function getHash(): string
    {
        return $this->items['hash'];
    }
}
