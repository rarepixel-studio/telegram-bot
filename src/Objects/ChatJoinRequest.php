<?php

namespace Telegram\Bot\Objects;

/**
 * Class ChatJoinRequest.
 *
 * Represents a join request sent to a chat.
 */
class ChatJoinRequest extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'chat' => Chat::class,
            'from' => User::class,
            'invite_link' => ChatInviteLink::class,
        ];
    }

    /**
     * Chat to which the request was sent.
     */
    public function getChat(): Chat
    {
        return $this->items['chat'];
    }

    /**
     * User that sent the join request.
     */
    public function getFrom(): User
    {
        return $this->items['from'];
    }

    /**
     * Identifier of a private chat with the user who sent the join request.
     */
    public function getUserChatId(): int
    {
        return $this->items['user_chat_id'];
    }

    /**
     * Date the request was sent in Unix time.
     */
    public function getDate(): int
    {
        return $this->items['date'];
    }

    /**
     * (Optional). Bio of the user.
     */
    public function getBio(): ?string
    {
        return $this->items['bio'] ?? null;
    }

    /**
     * (Optional). Chat invite link that was used by the user to send the join request.
     */
    public function getInviteLink(): ?ChatInviteLink
    {
        return $this->items['invite_link'] ?? null;
    }
}
