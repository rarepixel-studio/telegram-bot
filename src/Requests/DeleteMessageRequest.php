<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the deleteMessage method.
 *
 * Use this method to delete a message, including service messages, with the following limitations:
 * - A message can only be deleted if it was sent less than 48 hours ago.
 * - Service messages about a supergroup, channel, or forum topic creation can't be deleted.
 * - A dice message in a private chat can only be deleted if it was sent more than 24 hours ago.
 * - Bots can delete outgoing messages in private chats, groups, and supergroups.
 * - Bots can delete incoming messages in private chats.
 * - Bots granted can_post_messages permissions can delete outgoing messages in channels.
 * - If the bot is an administrator of a group, it can delete any message there.
 * - If the bot has can_delete_messages permission in a supergroup or a channel, it can delete any message there.
 *
 * @link https://core.telegram.org/bots/api#deletemessage
 */
class DeleteMessageRequest extends TelegramApiRequest
{
    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     * @param  int  $message_id  Identifier of the message to delete
     */
    public function __construct(
        protected int|string $chat_id,
        protected int $message_id,
    ) {}

    public function getMethod(): string
    {
        return 'deleteMessage';
    }

    public function validate(): void
    {
        // Basic validation
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'message_id' => $this->message_id,
        ];
    }
}
