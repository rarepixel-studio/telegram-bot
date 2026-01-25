<?php

namespace Telegram\Bot\Requests;

use Telegram\Bot\Exceptions\TelegramValidationException;

/**
 * Request object for the setMessageReaction method.
 *
 * Use this method to change the chosen reactions on a message.
 * Service messages can't be reacted to. Automatically forwarded messages from a channel to its discussion group have the same available reactions as messages in the channel.
 *
 * @link https://core.telegram.org/bots/api#setmessagereaction
 */
class SetMessageReactionRequest extends TelegramApiRequest
{
    protected array $params = [];

    /**
     * @param  int|string  $chat_id  Unique identifier for the target chat or username of the target channel
     * @param  int  $message_id  Identifier of the target message
     */
    public function __construct(
        protected int|string $chat_id,
        protected int $message_id,
    ) {}

    /**
     * A JSON-serialized list of reaction types to set on the message.
     * Currently, as non-premium users, bots can set up to one reaction per message.
     *
     * @param  array  $reaction  List of ReactionType objects
     */
    public function reaction(array $reaction): self
    {
        $this->params['reaction'] = $reaction;

        return $this;
    }

    /**
     * Pass True to set the reaction with a big animation.
     */
    public function isBig(bool $is_big): self
    {
        $this->params['is_big'] = $is_big;

        return $this;
    }

    public function getMethod(): string
    {
        return 'setMessageReaction';
    }

    public function validate(): void
    {
        if ($this->message_id <= 0) {
            throw new TelegramValidationException('message_id must be greater than 0');
        }
    }

    public function buildParams(): array
    {
        return [
            'chat_id' => $this->chat_id,
            'message_id' => $this->message_id,
        ] + $this->params;
    }
}
