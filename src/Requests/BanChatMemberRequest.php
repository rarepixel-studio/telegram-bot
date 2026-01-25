<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the banChatMember method.
 *
 * Use this method to ban a user in a group, a supergroup or a channel.
 * In the case of supergroups and channels, the user will not be able to return to the chat on their own using invite links, etc., unless unbanned first.
 *
 * @link https://core.telegram.org/bots/api#banchatmember
 */
class BanChatMemberRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target group or username of the target supergroup or channel
     * @param  int  $user_id  Unique identifier of the target user
     */
    public function __construct(
        protected int|string $chat_id,
        protected int $user_id,
    ) {}

    /**
     * Date when the user will be unbanned; Unix time. If user is banned for more than 366 days or less than 30 seconds from the current time they are considered to be banned forever.
     */
    public function untilDate(int $until_date): self
    {
        $this->params['until_date'] = $until_date;

        return $this;
    }

    /**
     * Pass True to delete all messages from the chat for the user that is being removed.
     */
    public function revokeMessages(bool $revoke_messages): self
    {
        $this->params['revoke_messages'] = $revoke_messages;

        return $this;
    }

    public function getMethod(): string
    {
        return 'banChatMember';
    }

    public function validate(): void
    {
        if ($this->user_id <= 0) {
            throw new TelegramValidationException('user_id must be greater than 0');
        }

        if (isset($this->params['until_date'])) {
            $currentTime = time();
            $untilDate = $this->params['until_date'];

            // Check if until_date is in the past or too soon
            if ($untilDate < $currentTime + 30) {
                throw new TelegramValidationException('until_date must be at least 30 seconds in the future');
            }
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
