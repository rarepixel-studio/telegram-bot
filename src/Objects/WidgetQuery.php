<?php

namespace Telegram\Bot\Objects;

/**
 * An incoming query from a widget sent by or via the bot.
 *
 * @link https://core.telegram.org/bots/api#widgetquery
 */
class WidgetQuery extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'from' => User::class,
            'chat' => Chat::class,
            'type' => WidgetQueryType::class,
        ];
    }

    /**
     * The unique identifier.
     */
    public function getId(): string
    {
        return $this->items['id'];
    }

    /**
     * The sender of the query.
     */
    public function getFrom(): User
    {
        return $this->items['from'];
    }

    /**
     * The chat containing the widget message, when available.
     */
    public function getChat(): ?Chat
    {
        return $this->items['chat'] ?? null;
    }

    /**
     * Identifier of the message containing the widget.
     */
    public function getMessageId(): ?int
    {
        return $this->items['message_id'] ?? null;
    }

    /**
     * Identifier of the inline message containing the widget.
     */
    public function getInlineMessageId(): ?string
    {
        return $this->items['inline_message_id'] ?? null;
    }

    /**
     * Global identifier, uniquely corresponding to the chat to which the message with the widget was sent.
     */
    public function getChatInstance(): string
    {
        return $this->items['chat_instance'];
    }

    /**
     * For widgets in inline messages, type of the chat to which the message was sent.
     */
    public function getChatType(): ?string
    {
        return $this->items['chat_type'] ?? null;
    }

    /**
     * The type of the query.
     */
    public function getType(): WidgetQueryType
    {
        return $this->items['type'];
    }

    /**
     * Data sent by the widget.
     */
    public function getData(): string
    {
        return $this->items['data'];
    }

    /**
     * Unique identifier of the shared widget, which sent the query.
     */
    public function getWidgetId(): ?string
    {
        return $this->items['widget_id'] ?? null;
    }
}
