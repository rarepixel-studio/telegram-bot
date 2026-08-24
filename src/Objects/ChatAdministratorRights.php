<?php

namespace Telegram\Bot\Objects;

/**
 * Class ChatAdministratorRights.
 *
 * Represents the rights of an administrator in a chat.
 */
class ChatAdministratorRights extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * True, if the user's presence in the chat is hidden.
     */
    public function getIsAnonymous(): bool
    {
        return $this->items['is_anonymous'];
    }

    /**
     * True, if the administrator can access the chat event log, get boost list, see hidden supergroup and channel members, etc.
     */
    public function getCanManageChat(): bool
    {
        return $this->items['can_manage_chat'];
    }

    /**
     * True, if the administrator can delete messages of other users.
     */
    public function getCanDeleteMessages(): bool
    {
        return $this->items['can_delete_messages'];
    }

    /**
     * True, if the administrator can manage video chats.
     */
    public function getCanManageVideoChats(): bool
    {
        return $this->items['can_manage_video_chats'];
    }

    /**
     * True, if the administrator can restrict, ban or unban chat members.
     */
    public function getCanRestrictMembers(): bool
    {
        return $this->items['can_restrict_members'];
    }

    /**
     * True, if the administrator can add new administrators.
     */
    public function getCanPromoteMembers(): bool
    {
        return $this->items['can_promote_members'];
    }

    /**
     * True, if the user is allowed to change the chat title, photo and other settings.
     */
    public function getCanChangeInfo(): bool
    {
        return $this->items['can_change_info'];
    }

    /**
     * True, if the user is allowed to invite new users to the chat.
     */
    public function getCanInviteUsers(): bool
    {
        return $this->items['can_invite_users'];
    }

    /**
     * True, if the administrator can post stories to the chat.
     */
    public function getCanPostStories(): bool
    {
        return $this->items['can_post_stories'];
    }

    /**
     * True, if the administrator can edit stories posted by other users.
     */
    public function getCanEditStories(): bool
    {
        return $this->items['can_edit_stories'];
    }

    /**
     * True, if the administrator can delete stories posted by other users.
     */
    public function getCanDeleteStories(): bool
    {
        return $this->items['can_delete_stories'];
    }

    /**
     * (Optional). True, if the administrator can post messages in the channel.
     */
    public function getCanPostMessages(): ?bool
    {
        return $this->items['can_post_messages'] ?? null;
    }

    /**
     * (Optional). True, if the administrator can edit messages of other users.
     */
    public function getCanEditMessages(): ?bool
    {
        return $this->items['can_edit_messages'] ?? null;
    }

    /**
     * (Optional). True, if the user is allowed to pin messages.
     */
    public function getCanPinMessages(): ?bool
    {
        return $this->items['can_pin_messages'] ?? null;
    }

    /**
     * (Optional). True, if the user is allowed to create, rename, close, and reopen forum topics.
     */
    public function getCanManageTopics(): ?bool
    {
        return $this->items['can_manage_topics'] ?? null;
    }

    /**
     * (Optional). True, if the administrator can manage direct messages of the channel.
     */
    public function getCanManageDirectMessages(): ?bool
    {
        return $this->items['can_manage_direct_messages'] ?? null;
    }

    /**
     * (Optional). True, if the administrator can manage member tags in the chat.
     */
    public function getCanManageTags(): ?bool
    {
        return $this->items['can_manage_tags'] ?? null;
    }

    /**
     * True, if the administrator can manage chat welcome messages or directly send them in the case of bots.
     */
    public function getCanSendWelcomeMessages(): bool
    {
        return $this->items['can_send_welcome_messages'];
    }
}
