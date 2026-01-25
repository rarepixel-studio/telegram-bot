<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the setChatPermissions method.
 *
 * Use this method to set default chat permissions for all members.
 *
 * @link https://core.telegram.org/bots/api#setchatpermissions
 */
class SetChatPermissionsRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target supergroup
     * @param  array  $permissions  New default chat permissions
     */
    public function __construct(
        protected int|string $chat_id,
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

    public function getMethod(): string
    {
        return 'setChatPermissions';
    }

    public function validate(): void
    {
        if (! is_array($this->permissions)) {
            throw new TelegramValidationException('permissions must be an array');
        }
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'permissions' => $this->permissions,
        ] + $this->params;
    }
}
