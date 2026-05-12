<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the getManagedBotAccessSettings method.
 *
 * Use this method to get the access settings of a managed bot.
 *
 * @link https://core.telegram.org/bots/api#getmanagedbotaccesssettings
 */
class GetManagedBotAccessSettingsRequest extends TelegramApiRequest
{
    /**
     * @param  int  $user_id  User identifier of the managed bot whose access settings will be returned
     */
    public function __construct(
        protected int $user_id,
    ) {}

    public function getMethod(): string
    {
        return 'getManagedBotAccessSettings';
    }

    public function validate(): void
    {
        // No specific validation needed
    }

    public function buildParams(): array
    {
        return [
            'user_id' => $this->user_id,
        ];
    }
}
