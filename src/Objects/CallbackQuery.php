<?php

namespace Telegram\Bot\Objects;

/**
 * Class CallbackQuery.
 */
class CallbackQuery extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'from' => User::class,
            'message' => Message::class,
        ];
    }

    /**
     * Unique message identifier.
     */
    public function getId(): int
    {
        return $this->items['id'];
    }

    /**
     * Sender.
     */
    public function getFrom(): User
    {
        return $this->items['from'];
    }

    /**
     * (Optional). Message with the callback button that originated the query. Note that message content and message date will not be available if the message is too old.
     */
    public function getMessage(): ?Message
    {
        return $this->items['message'] ?? null;
    }

    /**
     * (Optional). Identifier of the message sent via the bot in inline mode, that originated the query.
     */
    public function getInlineMessageId(): ?string
    {
        return $this->items['inline_message_id'] ?? null;
    }

    /**
     * Identifier, uniquely corresponding to the chat to which the message with the callback button was sent. Useful for high scores in games.
     */
    public function getChatInstance(): string
    {
        return $this->items['chat_instance'];
    }

    /**
     * (Optional). Data associated with the callback button. Be aware that a bad client can send arbitrary data in this field.
     */
    public function getData(): ?string
    {
        return $this->items['data'] ?? null;
    }

    /**
     * (Optional). Short name of a Game to be returned, serves as the unique identifier for the game.
     */
    public function getGameShortName(): ?string
    {
        return $this->items['game_short_name'] ?? null;
    }
}
