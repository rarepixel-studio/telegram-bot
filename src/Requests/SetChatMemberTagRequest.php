<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the setChatMemberTag method.
 *
 * Use this method to change the tag of a regular member of a group or a supergroup chat.
 * The bot must be an administrator in the chat for this to work and must have the can_manage_tags administrator right.
 * Returns True on success.
 *
 * @link https://core.telegram.org/bots/api#setchatmembertag
 */
class SetChatMemberTagRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target supergroup
     * @param  int  $user_id  Unique identifier of the target user
     */
    public function __construct(
        protected int|string $chat_id,
        protected int $user_id,
    ) {}

    /**
     * New tag for the member; 0-128 characters.
     */
    public function tag(?string $tag): self
    {
        $this->params['tag'] = $tag;

        return $this;
    }

    public function getMethod(): string
    {
        return 'setChatMemberTag';
    }

    public function validate(): void
    {
        if ($this->user_id <= 0) {
            throw new TelegramValidationException('user_id must be greater than 0');
        }

        if (isset($this->params['tag']) && mb_strlen($this->params['tag']) > 128) {
            throw new TelegramValidationException('tag must not exceed 128 characters');
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
