<?php

namespace Telegram\Bot\Objects;

/**
 * An incoming query from a forwarded shared widget.
 *
 * @link https://core.telegram.org/bots/api#sharedwidgetquery
 */
class SharedWidgetQuery extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'from' => User::class,
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
    public function getWidgetId(): string
    {
        return $this->items['widget_id'];
    }
}
