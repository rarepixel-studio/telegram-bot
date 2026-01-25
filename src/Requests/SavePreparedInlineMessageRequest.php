<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the savePreparedInlineMessage method.
 *
 * Use this method to store a message that can be sent by a user of a Mini App.
 *
 * @link https://core.telegram.org/bots/api#savepreparedinlinemessage
 */
class SavePreparedInlineMessageRequest extends TelegramApiRequest
{
    /**
     * @param  int  $user_id  Unique identifier of the target user that can use the prepared message
     * @param  array  $result  A JSON-serialized object describing the message to be sent
     */
    public function __construct(
        protected int $user_id,
        protected array $result,
    ) {}

    protected array $params = [];

    public function allowUserChats(bool $allow_user_chats): self
    {
        $this->params['allow_user_chats'] = $allow_user_chats;

        return $this;
    }

    public function allowBotChats(bool $allow_bot_chats): self
    {
        $this->params['allow_bot_chats'] = $allow_bot_chats;

        return $this;
    }

    public function allowGroupChats(bool $allow_group_chats): self
    {
        $this->params['allow_group_chats'] = $allow_group_chats;

        return $this;
    }

    public function allowChannelChats(bool $allow_channel_chats): self
    {
        $this->params['allow_channel_chats'] = $allow_channel_chats;

        return $this;
    }

    public function getMethod(): string
    {
        return 'savePreparedInlineMessage';
    }

    public function validate(): void
    {
        if ($this->user_id <= 0) {
            throw new TelegramValidationException('user_id must be greater than 0');
        }
        if (empty($this->result)) {
            throw new TelegramValidationException('result cannot be empty');
        }
    }

    public function buildParams(): array
    {
        return [
            'user_id' => $this->user_id,
            'result' => json_encode($this->result),
        ] + $this->params;
    }
}
