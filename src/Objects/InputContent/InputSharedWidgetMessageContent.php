<?php

namespace Telegram\Bot\Objects\InputContent;

use Illuminate\Support\Collection;
use Telegram\Bot\Objects\InlineQuery\InlineBaseObject;
use Telegram\Bot\Objects\MessageEntity;

/**
 * An existing shared widget supplied as inline message content.
 *
 * @link https://core.telegram.org/bots/api#inputsharedwidgetmessagecontent
 */
class InputSharedWidgetMessageContent extends InlineBaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'caption_entities' => static fn (array $items): Collection => new Collection(array_map(static fn (MessageEntity|array $item): MessageEntity => $item instanceof MessageEntity ? $item : MessageEntity::fromArray($item), $items)),
        ];
    }

    /**
     * Unique identifier of the shared widget created by the bot.
     */
    public function getWidgetId(): string
    {
        return $this->items['widget_id'];
    }

    /**
     * Data specific to the message containing the widget.
     */
    public function getChatData(): ?string
    {
        return $this->items['chat_data'] ?? null;
    }

    /**
     * Widget caption, 0-1024 characters after entities parsing.
     */
    public function getCaption(): ?string
    {
        return $this->items['caption'] ?? null;
    }

    /**
     * Mode for parsing entities in the widget caption.
     */
    public function getParseMode(): ?string
    {
        return $this->items['parse_mode'] ?? null;
    }

    /**
     * List of special entities that appear in the caption, which can be specified instead of parse_mode.
     *
     * @return Collection<int, MessageEntity>|null
     */
    public function getCaptionEntities(): ?Collection
    {
        return $this->items['caption_entities'] ?? null;
    }

    /**
     * Pass True if the caption must be shown above the widget.
     */
    public function getShowCaptionAboveMedia(): ?bool
    {
        return $this->items['show_caption_above_media'] ?? null;
    }
}
