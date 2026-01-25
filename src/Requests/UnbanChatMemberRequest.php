<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the unbanChatMember method.
 *
 * Use this method to unban a previously banned user in a supergroup or channel.
 * The user will not return to the group or channel automatically, but will be able to join via link, etc.
 *
 * @link https://core.telegram.org/bots/api#unbanchatmember
 */
class UnbanChatMemberRequest extends TelegramApiRequest
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
     * Do nothing if the user is not banned.
     */
    public function onlyIfBanned(bool $only_if_banned): self
    {
        $this->params['only_if_banned'] = $only_if_banned;

        return $this;
    }

    public function getMethod(): string
    {
        return 'unbanChatMember';
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
