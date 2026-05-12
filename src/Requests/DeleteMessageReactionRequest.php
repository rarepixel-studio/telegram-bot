<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the deleteMessageReaction method.
 *
 * Use this method to delete a reaction to a message.
 *
 * @link https://core.telegram.org/bots/api#deletemessagereaction
 */
class DeleteMessageReactionRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target supergroup
     * @param  int  $message_id  Identifier of the target message
     */
    public function __construct(
        protected int|string $chat_id,
        protected int $message_id,
    ) {}

    /**
     * Identifier of the user whose reaction will be removed, if the reaction was added by a user.
     */
    public function userId(int $user_id): self
    {
        $this->params['user_id'] = $user_id;

        return $this;
    }

    /**
     * Identifier of the chat whose reaction will be removed, if the reaction was added by a chat.
     */
    public function actorChatId(int $actor_chat_id): self
    {
        $this->params['actor_chat_id'] = $actor_chat_id;

        return $this;
    }

    public function getMethod(): string
    {
        return 'deleteMessageReaction';
    }

    public function validate(): void
    {
        // No specific validation needed
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'message_id' => $this->message_id,
        ] + $this->params;
    }
}
