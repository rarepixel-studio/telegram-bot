<?php

namespace Telegram\Bot\Objects;

/**
 * Class User.
 *
 * This object represents a Telegram user or bot.
 */
class User extends BaseObject
{
    /**
     * Define relations for the User object.
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Unique identifier for this user or bot.
     */
    public function getId(): int
    {
        return $this->items['id'];
    }

    /**
     * True, if this user is a bot.
     */
    public function getIsBot(): bool
    {
        return $this->items['is_bot'];
    }

    /**
     * User's or bot's first name.
     */
    public function getFirstName(): string
    {
        return $this->items['first_name'];
    }

    /**
     * (Optional). User's or bot's last name.
     */
    public function getLastName(): ?string
    {
        return $this->items['last_name'] ?? null;
    }

    /**
     * (Optional). User's or bot's username.
     */
    public function getUsername(): ?string
    {
        return $this->items['username'] ?? null;
    }

    /**
     * (Optional). IETF language tag of the user's language.
     */
    public function getLanguageCode(): ?string
    {
        return $this->items['language_code'] ?? null;
    }

    /**
     * (Optional). True, if this user is a Telegram Premium user.
     */
    public function getIsPremium(): ?bool
    {
        return $this->items['is_premium'] ?? null;
    }

    /**
     * (Optional). True, if this user added the bot to the attachment menu.
     */
    public function getAddedToAttachmentMenu(): ?bool
    {
        return $this->items['added_to_attachment_menu'] ?? null;
    }

    /**
     * (Optional). True, if the bot can be invited to groups. Returned only in getMe.
     */
    public function getCanJoinGroups(): ?bool
    {
        return $this->items['can_join_groups'] ?? null;
    }

    /**
     * (Optional). True, if privacy mode is disabled for the bot. Returned only in getMe.
     */
    public function getCanReadAllGroupMessages(): ?bool
    {
        return $this->items['can_read_all_group_messages'] ?? null;
    }

    /**
     * (Optional). True, if the bot supports inline queries. Returned only in getMe.
     */
    public function getSupportsInlineQueries(): ?bool
    {
        return $this->items['supports_inline_queries'] ?? null;
    }

    /**
     * (Optional). True, if the bot can be connected to a Telegram Business account. Returned only in getMe.
     */
    public function getCanConnectToBusiness(): ?bool
    {
        return $this->items['can_connect_to_business'] ?? null;
    }

    /**
     * (Optional). True, if the bot has a main Web App. Returned only in getMe.
     */
    public function getHasMainWebApp(): ?bool
    {
        return $this->items['has_main_web_app'] ?? null;
    }

    /**
     * (Optional). True, if the bot has forum topic mode enabled in private chats.
     * Returned only in getMe.
     */
    public function getHasTopicsEnabled(): ?bool
    {
        return $this->items['has_topics_enabled'] ?? null;
    }

    /**
     * (Optional). True, if users are allowed to create and delete topics in private
     * chats with this bot. Returned only in getMe.
     */
    public function getAllowsUsersToCreateTopics(): ?bool
    {
        return $this->items['allows_users_to_create_topics'] ?? null;
    }

    /**
     * (Optional). True, if the bot can manage other bots.
     */
    public function getCanManageBots(): ?bool
    {
        return $this->items['can_manage_bots'] ?? null;
    }

    /**
     * (Optional). True, if the bot supports join request queries. Returned only in getMe.
     */
    public function getSupportsJoinRequestQueries(): ?bool
    {
        return $this->items['supports_join_request_queries'] ?? null;
    }

    /**
     * (Optional). True, if the bot supports guest queries from chats it is not a member of. Returned only in getMe.
     */
    public function getSupportsGuestQueries(): ?bool
    {
        return $this->items['supports_guest_queries'] ?? null;
    }
}
