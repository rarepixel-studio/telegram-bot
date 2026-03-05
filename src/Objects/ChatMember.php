<?php

namespace Telegram\Bot\Objects;

/**
 * Class ChatMember *
 */
class ChatMember extends BaseObject
{
    /**
     * Property relations.
     */
    public function relations(): array
    {
        return [
            'user' => User::class,
        ];
    }

    /**
     * The member's status in the chat. Can be "creator", "administrator", "member", "left" or "kicked".
     *
     * @return string
     */
    public function getStatus(): mixed
    {
        return $this['status'];
    }

    /**
     * Information about the user.
     */
    public function getUser(): User
    {
        return $this->items['user'];
    }

    /**
     * (Optional). Restictred and kicked only. Date when restrictions will be lifted for this user, unix time.
     */
    public function getUntilDate(): ?int
    {
        return $this->items['until_date'] ?? null;
    }

    /**
     * (Optional). Administrators only. True, if the bot is allowed to edit administrator privileges of that user.
     */
    public function getCanBeEdited(): ?bool
    {
        return $this->items['can_be_edited'] ?? null;
    }

    /**
     * (Optional). Administrators only. True, if the administrator can change the chat title, photo and other settings.
     */
    public function getCanChangeInfo(): ?bool
    {
        return $this->items['can_change_info'] ?? null;
    }

    /**
     * (Optional). Administrators only. True, if the administrator can post in the channel, channels only.
     */
    public function getCanPostMessages(): ?bool
    {
        return $this->items['can_post_messages'] ?? null;
    }

    /**
     * (Optional). Administrators only. True, if the administrator can edit messages of other users, channels only.
     */
    public function getCanEditMessages(): ?bool
    {
        return $this->items['can_edit_messages'] ?? null;
    }

    /**
     * (Optional). Administrators only. True, if the administrator can delete messages of other users.
     */
    public function getCanDeleteMessages(): ?bool
    {
        return $this->items['can_delete_messages'] ?? null;
    }

    /**
     * (Optional). Administrators only. True, if the administrator can invite new users to the chat.
     */
    public function getCanInviteUsers(): ?bool
    {
        return $this->items['can_invite_users'] ?? null;
    }

    /**
     * (Optional). Administrators only. True, if the administrator can restrict, ban or unban chat members.
     */
    public function getCanRestrictMembers(): ?bool
    {
        return $this->items['can_restrict_members'] ?? null;
    }

    /**
     * (Optional). Administrators only. True, if the administrator can pin messages, supergroups only.
     */
    public function getCanPinMessages(): ?bool
    {
        return $this->items['can_pin_messages'] ?? null;
    }

    /**
     * (Optional). Administrators only. True, if the administrator can add new administrators with a subset of his own privileges or demote administrators that he has promoted, directly or indirectly (promoted by administrators that were appointed by the user).
     */
    public function getCanPromoteMembers(): ?bool
    {
        return $this->items['can_promote_members'] ?? null;
    }

    /**
     * (Optional). Restricted only. True, if the user is a member of the chat at the moment of the request
     */
    public function getIsMember(): ?bool
    {
        return $this->items['is_member'] ?? null;
    }

    /**
     * (Optional). Restricted only. True, if the user can send text messages, contacts, locations and venues.
     */
    public function getCanSendMessages(): ?bool
    {
        return $this->items['can_send_messages'] ?? null;
    }

    /**
     * (Optional). Restricted only. True, if the user can send audios, documents, photos, videos, video notes and voice notes, implies can_send_messages.
     */
    public function getCanSendMediaMessages(): ?bool
    {
        return $this->items['can_send_media_messages'] ?? null;
    }

    /**
     * (Optional). Restricted only. True, if the user can send animations, games, stickers and use inline bots, implies can_send_media_messages.
     */
    public function getCanSendOtherMessages(): ?bool
    {
        return $this->items['can_send_other_messages'] ?? null;
    }

    /**
     * (Optional). Restricted only. True, if user may add web page previews to his messages, implies can_send_media_messages.
     */
    public function getCanAddWebPagePreviews(): ?bool
    {
        return $this->items['can_add_web_page_previews'] ?? null;
    }

    /**
     * (Optional). Custom tag assigned to the chat member.
     */
    public function getTag(): ?string
    {
        return $this->items['tag'] ?? null;
    }

    /**
     * (Optional). True, if the user is allowed to edit their tag in the chat.
     */
    public function getCanEditTag(): ?bool
    {
        return $this->items['can_edit_tag'] ?? null;
    }

    /**
     * (Optional). Administrators only. True, if the administrator can manage member tags in the chat.
     */
    public function getCanManageTags(): ?bool
    {
        return $this->items['can_manage_tags'] ?? null;
    }
}
