<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the createChatInviteLink method.
 *
 * Use this method to create an additional invite link for a chat.
 *
 * @link https://core.telegram.org/bots/api#createchatinvitelink
 */
class CreateChatInviteLinkRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     */
    public function __construct(
        protected int|string $chat_id,
    ) {}

    /**
     * Invite link name; 0-32 characters.
     */
    public function name(string $name): self
    {
        $this->params['name'] = $name;

        return $this;
    }

    /**
     * Point in time (Unix timestamp) when the link will expire.
     */
    public function expireDate(int $expire_date): self
    {
        $this->params['expire_date'] = $expire_date;

        return $this;
    }

    /**
     * Maximum number of users that can be members of the chat simultaneously after joining via this link; 1-99999.
     */
    public function memberLimit(int $member_limit): self
    {
        $this->params['member_limit'] = $member_limit;

        return $this;
    }

    /**
     * True, if users joining the chat via the link need to be approved by chat administrators.
     */
    public function createsJoinRequest(bool $creates_join_request): self
    {
        $this->params['creates_join_request'] = $creates_join_request;

        return $this;
    }

    public function getMethod(): string
    {
        return 'createChatInviteLink';
    }

    public function validate(): void
    {
        if (isset($this->params['name'])) {
            $nameLength = mb_strlen($this->params['name']);
            if ($nameLength > 32) {
                throw new TelegramValidationException('name must not exceed 32 characters');
            }
        }

        if (isset($this->params['member_limit'])) {
            $limit = $this->params['member_limit'];
            if ($limit < 1 || $limit > 99999) {
                throw new TelegramValidationException('member_limit must be between 1 and 99999');
            }
        }
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
        ] + $this->params;
    }
}
