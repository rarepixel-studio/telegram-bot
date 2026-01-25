<?php

namespace Telegram\Bot\Objects;

/**
 * Class ChatInviteLink.
 *
 * Represents an invite link for a chat.
 */
class ChatInviteLink extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'creator' => User::class,
        ];
    }

    /**
     * The invite link.
     */
    public function getInviteLink(): string
    {
        return $this->items['invite_link'];
    }

    /**
     * Creator of the link.
     */
    public function getCreator(): User
    {
        return $this->items['creator'];
    }

    /**
     * True, if users joining the chat via the link need to be approved by chat administrators.
     */
    public function getCreatesJoinRequest(): bool
    {
        return $this->items['creates_join_request'];
    }

    /**
     * True, if the link is primary.
     */
    public function getIsPrimary(): bool
    {
        return $this->items['is_primary'];
    }

    /**
     * True, if the link is revoked.
     */
    public function getIsRevoked(): bool
    {
        return $this->items['is_revoked'];
    }

    /**
     * (Optional). Invite link name.
     */
    public function getName(): ?string
    {
        return $this->items['name'] ?? null;
    }

    /**
     * (Optional). Point in time (Unix timestamp) when the link will expire or has been expired.
     */
    public function getExpireDate(): ?int
    {
        return $this->items['expire_date'] ?? null;
    }

    /**
     * (Optional). The maximum number of users that can be members of the chat simultaneously after joining the chat via this invite link.
     */
    public function getMemberLimit(): ?int
    {
        return $this->items['member_limit'] ?? null;
    }

    /**
     * (Optional). Number of pending join requests created using this link.
     */
    public function getPendingJoinRequestCount(): ?int
    {
        return $this->items['pending_join_request_count'] ?? null;
    }

    /**
     * (Optional). The number of seconds the subscription will be active for before the next payment.
     */
    public function getSubscriptionPeriod(): ?int
    {
        return $this->items['subscription_period'] ?? null;
    }

    /**
     * (Optional). The amount of Telegram Stars a user must pay.
     */
    public function getSubscriptionPrice(): ?int
    {
        return $this->items['subscription_price'] ?? null;
    }
}
