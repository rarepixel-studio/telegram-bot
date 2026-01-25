<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the exportChatInviteLink method.
 *
 * Use this method to generate a new primary invite link for a chat.
 *
 * @link https://core.telegram.org/bots/api#exportchatinvitelink
 */
class ExportChatInviteLinkRequest extends TelegramApiRequest
{
    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     */
    public function __construct(
        protected int|string $chat_id,
    ) {}

    public function getMethod(): string
    {
        return 'exportChatInviteLink';
    }

    public function validate(): void
    {
        // No specific validation needed
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
        ];
    }
}
