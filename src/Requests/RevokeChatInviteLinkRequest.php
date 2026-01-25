<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the revokeChatInviteLink method.
 *
 * Use this method to revoke an invite link created by the bot.
 *
 * @link https://core.telegram.org/bots/api#revokechatinvitelink
 */
class RevokeChatInviteLinkRequest extends TelegramApiRequest
{
    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     * @param  string  $invite_link  The invite link to revoke
     */
    public function __construct(
        protected int|string $chat_id,
        protected string $invite_link,
    ) {}

    public function getMethod(): string
    {
        return 'revokeChatInviteLink';
    }

    public function validate(): void
    {
        if (empty($this->invite_link)) {
            throw new TelegramValidationException('invite_link cannot be empty');
        }
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'invite_link' => $this->invite_link,
        ];
    }
}
