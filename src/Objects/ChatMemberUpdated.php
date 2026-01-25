<?php

namespace Telegram\Bot\Objects;

/**
 * Class ChatMemberUpdated.
 *
 * This object represents changes in the status of a chat member.
 *
 * @link https://core.telegram.org/bots/api#chatmemberupdated
 */
class ChatMemberUpdated extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'chat' => Chat::class,
            'from' => User::class,
            'old_chat_member' => ChatMember::class,
            'new_chat_member' => ChatMember::class,
            'invite_link' => ChatInviteLink::class,
        ];
    }

    /**
     * Chat the user belongs to.
     */
    public function getChat(): Chat
    {
        return $this->items['chat'];
    }

    /**
     * Performer of the action, which resulted in the change.
     */
    public function getFrom(): User
    {
        return $this->items['from'];
    }

    /**
     * Date the change was done in Unix time.
     */
    public function getDate(): int
    {
        return $this->items['date'];
    }

    /**
     * Previous information about the chat member.
     */
    public function getOldChatMember(): ChatMember
    {
        return $this->items['old_chat_member'];
    }

    /**
     * New information about the chat member.
     */
    public function getNewChatMember(): ChatMember
    {
        return $this->items['new_chat_member'];
    }

    /**
     * (Optional). Chat invite link, which was used by the user to join the chat.
     */
    public function getInviteLink(): ?ChatInviteLink
    {
        return $this->items['invite_link'] ?? null;
    }

    /**
     * (Optional). True, if the user joined the chat after sending a direct join request without using an invite link.
     */
    public function getViaJoinRequest(): ?bool
    {
        return $this->items['via_join_request'] ?? null;
    }

    /**
     * (Optional). True, if the user joined the chat via a chat folder invite link.
     */
    public function getViaChatFolderInviteLink(): ?bool
    {
        return $this->items['via_chat_folder_invite_link'] ?? null;
    }
}
