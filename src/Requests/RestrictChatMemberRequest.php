<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the restrictChatMember method.
 *
 * Use this method to restrict a user in a supergroup.
 * The bot must be an administrator in the supergroup for this to work and must have the appropriate administrator rights.
 *
 * @link https://core.telegram.org/bots/api#restrictchatmember
 */
class RestrictChatMemberRequest extends TelegramApiRequest
{
    /**
     * {@inheritdoc}
     */
    protected array $jsonSerializedFields = [
        'permissions',
    ];

    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target supergroup
     * @param  int  $user_id  Unique identifier of the target user
     * @param  array  $permissions  New user permissions
     */
    public function __construct(
        protected int|string $chat_id,
        protected int $user_id,
        protected array $permissions,
    ) {}

    /**
     * Pass True if chat permissions are set independently.
     */
    public function useIndependentChatPermissions(bool $use_independent_chat_permissions): self
    {
        $this->params['use_independent_chat_permissions'] = $use_independent_chat_permissions;

        return $this;
    }

    /**
     * Date when restrictions will be lifted for the user; Unix time.
     */
    public function untilDate(int $until_date): self
    {
        $this->params['until_date'] = $until_date;

        return $this;
    }

    public function getMethod(): string
    {
        return 'restrictChatMember';
    }

    public function validate(): void
    {
        if ($this->user_id <= 0) {
            throw new TelegramValidationException('user_id must be greater than 0');
        }

        // Permissions should be an array
        if (! is_array($this->permissions)) {
            throw new TelegramValidationException('permissions must be an array');
        }

        if (isset($this->params['until_date'])) {
            $currentTime = time();
            $untilDate = $this->params['until_date'];

            if ($untilDate < $currentTime + 30) {
                throw new TelegramValidationException('until_date must be at least 30 seconds in the future');
            }
        }
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'user_id' => $this->user_id,
            'permissions' => $this->permissions,
        ] + $this->params;
    }
}
