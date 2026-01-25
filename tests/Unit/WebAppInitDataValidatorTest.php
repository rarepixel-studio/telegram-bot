<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use Telegram\Bot\WebAppInitDataValidator;

class WebAppInitDataValidatorTest extends TestCase
{
    public function test_it_returns_true_when_init_data_is_valid()
    {
        $botToken = '123456:ABCDEF';
        $data = [
            'auth_date' => (string) time(),
            'query_id' => 'AAE123',
            'user' => json_encode(['id' => 1, 'first_name' => 'Ada'], JSON_UNESCAPED_UNICODE),
        ];

        $initData = $this->buildInitData($data, $botToken);

        $this->assertTrue(WebAppInitDataValidator::isValid($initData, $botToken));
    }

    public function test_it_returns_false_when_hash_is_invalid()
    {
        $botToken = '123456:ABCDEF';
        $data = [
            'auth_date' => (string) time(),
            'query_id' => 'AAE123',
            'user' => json_encode(['id' => 1, 'first_name' => 'Ada'], JSON_UNESCAPED_UNICODE),
        ];

        $data['hash'] = 'deadbeef';
        $initData = http_build_query($data, '', '&', PHP_QUERY_RFC3986);

        $this->assertFalse(WebAppInitDataValidator::isValid($initData, $botToken));
    }

    public function test_it_returns_false_when_auth_date_is_expired()
    {
        $botToken = '123456:ABCDEF';
        $data = [
            'auth_date' => (string) (time() - 90000),
            'query_id' => 'AAE123',
            'user' => json_encode(['id' => 1, 'first_name' => 'Ada'], JSON_UNESCAPED_UNICODE),
        ];

        $initData = $this->buildInitData($data, $botToken);

        $this->assertFalse(WebAppInitDataValidator::isValid($initData, $botToken));
    }

    public function test_it_returns_false_when_auth_date_is_missing()
    {
        $botToken = '123456:ABCDEF';
        $data = [
            'query_id' => 'AAE123',
            'user' => json_encode(['id' => 1, 'first_name' => 'Ada'], JSON_UNESCAPED_UNICODE),
        ];

        $initData = $this->buildInitData($data, $botToken);

        $this->assertFalse(WebAppInitDataValidator::isValid($initData, $botToken));
    }

    /**
     * @param  array<string, string>  $data
     */
    private function buildInitData(array $data, string $botToken): string
    {
        $data['hash'] = $this->generateHash($data, $botToken);

        return http_build_query($data, '', '&', PHP_QUERY_RFC3986);
    }

    /**
     * @param  array<string, string>  $data
     */
    private function generateHash(array $data, string $botToken): string
    {
        ksort($data);

        $lines = [];

        foreach ($data as $key => $value) {
            $lines[] = $key.'='.$value;
        }

        $dataCheckString = implode("\n", $lines);
        $secretKey = hash_hmac('sha256', $botToken, 'WebAppData', true);

        return bin2hex(hash_hmac('sha256', $dataCheckString, $secretKey, true));
    }
}
