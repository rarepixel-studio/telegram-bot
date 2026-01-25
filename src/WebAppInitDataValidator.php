<?php

namespace Telegram\Bot;

/**
 * Class WebAppInitDataValidator.
 *
 * Validates Telegram Mini App initData.
 */
class WebAppInitDataValidator
{
    /**
     * Validate Telegram Mini App initData string.
     *
     * @param  string  $initData  Raw query string from Telegram.WebApp.initData.
     * @param  string  $botToken  Telegram bot token used to generate the secret key.
     * @param  int|null  $maxAgeSeconds  Max allowed age in seconds; null or <= 0 disables time check.
     */
    public static function isValid(string $initData, string $botToken, ?int $maxAgeSeconds = 86400): bool
    {
        $parsedData = self::parseInitData($initData);

        if (! isset($parsedData['hash'])) {
            return false;
        }

        if (! self::isAuthDateValid($parsedData['auth_date'] ?? null, $maxAgeSeconds)) {
            return false;
        }

        $dataCheckString = self::buildDataCheckString($parsedData);
        $secretKey = hash_hmac('sha256', $botToken, 'WebAppData', true);
        $expectedHash = bin2hex(hash_hmac('sha256', $dataCheckString, $secretKey, true));

        return hash_equals($expectedHash, $parsedData['hash']);
    }

    /**
     * Parse initData query string into a key/value map.
     *
     * @return array<string, string>
     */
    private static function parseInitData(string $initData): array
    {
        if ($initData === '') {
            return [];
        }

        $pairs = explode('&', $initData);
        $parsedData = [];

        foreach ($pairs as $pair) {
            if ($pair === '') {
                continue;
            }

            $parts = explode('=', $pair, 2);
            $key = rawurldecode($parts[0]);

            if ($key === '') {
                continue;
            }

            $value = $parts[1] ?? '';
            $parsedData[$key] = rawurldecode($value);
        }

        return $parsedData;
    }

    /**
     * Build data-check-string from initData fields.
     *
     * @param  array<string, string>  $parsedData
     */
    private static function buildDataCheckString(array $parsedData): string
    {
        unset($parsedData['hash']);
        ksort($parsedData);

        $lines = [];

        foreach ($parsedData as $key => $value) {
            $lines[] = $key.'='.$value;
        }

        return implode("\n", $lines);
    }

    /**
     * Validate the auth_date value against a max age.
     */
    private static function isAuthDateValid(?string $authDate, ?int $maxAgeSeconds): bool
    {
        if ($maxAgeSeconds === null || $maxAgeSeconds <= 0) {
            return true;
        }

        if ($authDate === null || $authDate === '' || ! ctype_digit($authDate)) {
            return false;
        }

        $authTimestamp = (int) $authDate;

        if ($authTimestamp <= 0) {
            return false;
        }

        return $authTimestamp >= (time() - $maxAgeSeconds);
    }
}
