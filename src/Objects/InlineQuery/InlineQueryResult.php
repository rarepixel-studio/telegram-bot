<?php

namespace Telegram\Bot\Objects\InlineQuery;

use Telegram\Bot\Objects\InlineKeyboardMarkup;

/**
 * Class InlineQueryResult.
 */
abstract class InlineQueryResult extends InlineBaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'reply_markup' => InlineKeyboardMarkup::class,
        ];
    }

    /**
     * Unique identifier for this result.
     */
    public function getId(): string
    {
        return $this->items['id'];
    }

    /**
     * Type of the result.
     */
    public function getType(): string
    {
        return $this->items['type'];
    }

    /**
     * (Optional). Inline keyboard attached to the message.
     */
    public function getReplyMarkup(): ?InlineKeyboardMarkup
    {
        return $this->items['reply_markup'] ?? null;
    }

    /**
     * (Optional). Content of the message to be sent instead of the media.
     */
    public function getInputMessageContent(): InlineBaseObject|array|null
    {
        return $this->items['input_message_content'] ?? null;
    }
}
