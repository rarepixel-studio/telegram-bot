<?php

namespace Telegram\Bot\Objects\InputContent;

use Illuminate\Support\Collection;
use Telegram\Bot\Objects\InlineQuery\InlineBaseObject;
use Telegram\Bot\Objects\LinkPreviewOptions;
use Telegram\Bot\Objects\MessageEntity;

/**
 * Class InputTextMessageContent.
 *
 * Represents the content of a text message to be sent as the result of an inline query.
 *
 * @link https://core.telegram.org/bots/api#inputtextmessagecontent
 */
class InputTextMessageContent extends InlineBaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'entities' => MessageEntity::class,
            'link_preview_options' => LinkPreviewOptions::class,
        ];
    }

    /**
     * Text of the message to be sent, 1-4096 characters.
     */
    public function getMessageText(): string
    {
        return $this->items['message_text'];
    }

    /**
     * (Optional). Mode for parsing entities in the message text.
     */
    public function getParseMode(): ?string
    {
        return $this->items['parse_mode'] ?? null;
    }

    /**
     * (Optional). List of special entities that appear in message text.
     *
     * @return array<int, MessageEntity>|null
     */
    public function getEntities(): ?array
    {
        $entities = $this->items['entities'] ?? null;

        if ($entities instanceof Collection) {
            return $entities->all();
        }

        return $entities;
    }

    /**
     * (Optional). Options for link preview generation.
     */
    public function getLinkPreviewOptions(): ?LinkPreviewOptions
    {
        return $this->items['link_preview_options'] ?? null;
    }
}
