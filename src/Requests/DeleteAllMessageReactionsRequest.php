<?php

namespace Telegram\Bot\Requests;

/**
 * Request object for the deleteAllMessageReactions method.
 *
 * Use this method to delete all reactions to a message.
 *
 * @link https://core.telegram.org/bots/api#deleteallmessagereactions
 */
class DeleteAllMessageReactionsRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target supergroup
     */
    public function __construct(
        protected int|string $chat_id,
    ) {}

    /**
     * Identifier of the user whose reactions will be removed, if the reactions were added by a user.
     */
    public function userId(int $user_id): self
    {
        $this->params['user_id'] = $user_id;

        return $this;
    }

    /**
     * Identifier of the chat whose reactions will be removed, if the reactions were added by a chat.
     */
    public function actorChatId(int $actor_chat_id): self
    {
        $this->params['actor_chat_id'] = $actor_chat_id;

        return $this;
    }

    public function getMethod(): string
    {
        return 'deleteAllMessageReactions';
    }

    public function validate(): void
    {
        // No specific validation needed
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
        ] + $this->params;
    }
}
