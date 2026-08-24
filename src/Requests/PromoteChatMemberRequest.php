<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the promoteChatMember method.
 *
 * Use this method to promote or demote a user in a supergroup or a channel.
 * The bot must be an administrator in the chat for this to work and must have the appropriate administrator rights.
 *
 * @link https://core.telegram.org/bots/api#promotechatmember
 */
class PromoteChatMemberRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     * @param  int  $user_id  Unique identifier of the target user
     */
    public function __construct(
        protected int|string $chat_id,
        protected int $user_id,
    ) {}

    /**
     * Pass True if the administrator's presence in the chat is hidden.
     */
    public function isAnonymous(bool $is_anonymous): self
    {
        $this->params['is_anonymous'] = $is_anonymous;

        return $this;
    }

    /**
     * Pass True if the administrator can access the chat event log, get boost list, see hidden supergroup and channel members, report spam messages and ignore slow mode.
     */
    public function canManageChat(bool $can_manage_chat): self
    {
        $this->params['can_manage_chat'] = $can_manage_chat;

        return $this;
    }

    /**
     * Pass True if the administrator can delete messages of other users.
     */
    public function canDeleteMessages(bool $can_delete_messages): self
    {
        $this->params['can_delete_messages'] = $can_delete_messages;

        return $this;
    }

    /**
     * Pass True if the administrator can manage video chats.
     */
    public function canManageVideoChats(bool $can_manage_video_chats): self
    {
        $this->params['can_manage_video_chats'] = $can_manage_video_chats;

        return $this;
    }

    /**
     * Pass True if the administrator can restrict, ban or unban chat members, or access supergroup statistics.
     */
    public function canRestrictMembers(bool $can_restrict_members): self
    {
        $this->params['can_restrict_members'] = $can_restrict_members;

        return $this;
    }

    /**
     * Pass True if the administrator can add new administrators with a subset of their own privileges or demote administrators that they have promoted.
     */
    public function canPromoteMembers(bool $can_promote_members): self
    {
        $this->params['can_promote_members'] = $can_promote_members;

        return $this;
    }

    /**
     * Pass True if the administrator can change chat title, photo and other settings.
     */
    public function canChangeInfo(bool $can_change_info): self
    {
        $this->params['can_change_info'] = $can_change_info;

        return $this;
    }

    /**
     * Pass True if the administrator can invite new users to the chat.
     */
    public function canInviteUsers(bool $can_invite_users): self
    {
        $this->params['can_invite_users'] = $can_invite_users;

        return $this;
    }

    /**
     * Pass True if the administrator can post stories to the chat.
     */
    public function canPostStories(bool $can_post_stories): self
    {
        $this->params['can_post_stories'] = $can_post_stories;

        return $this;
    }

    /**
     * Pass True if the administrator can edit stories posted by other users, post stories to the chat page, pin chat stories, and access the chat's story archive.
     */
    public function canEditStories(bool $can_edit_stories): self
    {
        $this->params['can_edit_stories'] = $can_edit_stories;

        return $this;
    }

    /**
     * Pass True if the administrator can delete stories posted by other users.
     */
    public function canDeleteStories(bool $can_delete_stories): self
    {
        $this->params['can_delete_stories'] = $can_delete_stories;

        return $this;
    }

    /**
     * Pass True if the administrator can post messages in the channel, or access channel statistics; for channels only.
     */
    public function canPostMessages(bool $can_post_messages): self
    {
        $this->params['can_post_messages'] = $can_post_messages;

        return $this;
    }

    /**
     * Pass True if the administrator can edit messages of other users and can pin messages; for channels only.
     */
    public function canEditMessages(bool $can_edit_messages): self
    {
        $this->params['can_edit_messages'] = $can_edit_messages;

        return $this;
    }

    /**
     * Pass True if the administrator can pin messages; for supergroups only.
     */
    public function canPinMessages(bool $can_pin_messages): self
    {
        $this->params['can_pin_messages'] = $can_pin_messages;

        return $this;
    }

    /**
     * Pass True if the user is allowed to create, rename, close, and reopen forum topics; for supergroups only.
     */
    public function canManageTopics(bool $can_manage_topics): self
    {
        $this->params['can_manage_topics'] = $can_manage_topics;

        return $this;
    }

    /**
     * Pass True if the administrator can manage member tags in the chat.
     */
    public function canManageTags(bool $can_manage_tags): self
    {
        $this->params['can_manage_tags'] = $can_manage_tags;

        return $this;
    }

    /**
     * Pass True if the administrator can manage direct messages within the channel and decline suggested posts; for channels only.
     */
    public function canManageDirectMessages(bool $can_manage_direct_messages): self
    {
        $this->params['can_manage_direct_messages'] = $can_manage_direct_messages;

        return $this;
    }

    /**
     * Pass True if the administrator can manage chat welcome messages or directly send them in the case of bots.
     */
    public function canSendWelcomeMessages(bool $can_send_welcome_messages): self
    {
        $this->params['can_send_welcome_messages'] = $can_send_welcome_messages;

        return $this;
    }

    public function getMethod(): string
    {
        return 'promoteChatMember';
    }

    public function validate(): void
    {
        if ($this->user_id <= 0) {
            throw new TelegramValidationException('user_id must be greater than 0');
        }
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'user_id' => $this->user_id,
        ] + $this->params;
    }
}
