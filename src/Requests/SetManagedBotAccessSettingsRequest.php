<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the setManagedBotAccessSettings method.
 *
 * Use this method to change the access settings of a managed bot.
 *
 * @link https://core.telegram.org/bots/api#setmanagedbotaccesssettings
 */
class SetManagedBotAccessSettingsRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'added_user_ids',
    ];

    protected array $params = [];

    /**
     * @param  int  $user_id  User identifier of the managed bot whose access settings will be changed
     * @param  bool  $is_access_restricted  Pass True, if only selected users can access the bot
     */
    public function __construct(
        protected int $user_id,
        protected bool $is_access_restricted,
    ) {}

    /**
     * @param  array<int>  $added_user_ids  A JSON-serialized list of up to 10 identifiers of users who will have access to the bot in addition to its owner
     */
    public function addedUserIds(array $added_user_ids): self
    {
        $this->params['added_user_ids'] = $added_user_ids;

        return $this;
    }

    public function getMethod(): string
    {
        return 'setManagedBotAccessSettings';
    }

    public function validate(): void
    {
        if (isset($this->params['added_user_ids']) && count($this->params['added_user_ids']) > 10) {
            throw new TelegramValidationException('added_user_ids must not contain more than 10 users');
        }
    }

    public function buildParams(): array
    {
        return [
            'user_id' => $this->user_id,
            'is_access_restricted' => $this->is_access_restricted,
        ] + $this->params;
    }
}
