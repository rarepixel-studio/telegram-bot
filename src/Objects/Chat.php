<?php

namespace Telegram\Bot\Objects;

/**
 * Class Chat. *
 */
class Chat extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'photo' => ChatPhoto::class,
            'pinned_message' => Message::class,
            'background' => ChatBackground::class,
            'first_profile_audio' => Audio::class,
        ];
    }

    /**
     * Check if this is a private chat.
     *
     * @return bool
     */
    public function isPrivate()
    {
        return $this->getType() == 'private';
    }

    /**
     * Unique identifier for this chat, not exceeding 1e13 by absolute value.
     */
    public function getId(): int
    {
        return $this->items['id'];
    }

    /**
     * Type of chat, can be either 'private', 'group', 'supergroup' or 'channel'.
     */
    public function getType(): string
    {
        return $this->items['type'];
    }

    /**
     * (Optional). Title, for channels and group chats.
     */
    public function getTitle(): ?string
    {
        return $this->items['title'] ?? null;
    }

    /**
     * (Optional). Username, for private chats and channels if available
     */
    public function getUsername(): ?string
    {
        return $this->items['username'] ?? null;
    }

    /**
     * (Optional). First name of the other party in a private chat
     */
    public function getFirstName(): ?string
    {
        return $this->items['first_name'] ?? null;
    }

    /**
     * (Optional). Last name of the other party in a private chat
     */
    public function getLastName(): ?string
    {
        return $this->items['last_name'] ?? null;
    }

    /**
     * (Optional). True, if the supergroup chat is a forum (has topics enabled).
     */
    public function getIsForum(): ?bool
    {
        return $this->items['is_forum'] ?? null;
    }

    /**
     * (Optional). True, if the chat is the direct messages chat of a channel.
     */
    public function getIsDirectMessages(): ?bool
    {
        return $this->items['is_direct_messages'] ?? null;
    }

    /**
     * (Optional). True if a group has ‘All Members Are Admins’ enabled.
     */
    public function getAllMembersAreAdministrators(): ?bool
    {
        return $this->items['all_members_are_administrators'] ?? null;
    }

    /**
     * (Optional). Chat photo. Returned only in getChat.
     */
    public function getPhoto(): ?ChatPhoto
    {
        return $this->items['photo'] ?? null;
    }

    /**
     * (Optional). Description, for supergroups and channel chats. Returned only in getChat.
     */
    public function getDescription(): ?string
    {
        return $this->items['description'] ?? null;
    }

    /**
     * (Optional). Chat invite link, for supergroups and channel chats. Returned only in getChat.
     */
    public function getInviteLink(): ?string
    {
        return $this->items['invite_link'] ?? null;
    }

    /**
     * (Optional). Pinned message, for supergroups. Returned only in getChat.
     */
    public function getPinnedMessage(): ?Message
    {
        return $this->items['pinned_message'] ?? null;
    }

    /**
     * (Optional). For supergroups, name of group sticker set. Returned only in getChat.
     */
    public function getStickerSetName(): ?string
    {
        return $this->items['sticker_set_name'] ?? null;
    }

    /**
     * (Optional). True, if the bot can change the group sticker set. Returned only in getChat.
     */
    public function getCanSetStickerSet(): ?bool
    {
        return $this->items['can_set_sticker_set'] ?? null;
    }

    /**
     * (Optional). Background set for the chat.
     */
    public function getBackground(): ?ChatBackground
    {
        return $this->items['background'] ?? null;
    }

    /**
     * (Optional). The first profile audio set for the chat. Returned only in getChat.
     */
    public function getFirstProfileAudio(): ?Audio
    {
        return $this->items['first_profile_audio'] ?? null;
    }
}
