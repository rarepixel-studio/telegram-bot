<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the editChatInviteLink method.
 *
 * Use this method to edit a non-primary invite link created by the bot.
 *
 * @link https://core.telegram.org/bots/api#editchatinvitelink
 */
class EditChatInviteLinkRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     * @param  string  $invite_link  The invite link to edit
     */
    public function __construct(
        protected int|string $chat_id,
        protected string $invite_link,
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
        return 'editChatInviteLink';
    }

    public function validate(): void
    {
        if (empty($this->invite_link)) {
            throw new TelegramValidationException('invite_link cannot be empty');
        }

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
            'invite_link' => $this->invite_link,
        ] + $this->params;
    }
}
