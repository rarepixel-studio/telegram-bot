<?php

namespace Telegram\Bot\Objects\InputContent;

use Illuminate\Support\Collection;
use Telegram\Bot\Objects\InlineQuery\InlineBaseObject;
use Telegram\Bot\Objects\MessageEntity;

/**
 * An HTML widget supplied as inline message content.
 *
 * @link https://core.telegram.org/bots/api#inputwidgetmessagecontent
 */
class InputWidgetMessageContent extends InlineBaseObject
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
     * The HTML code of the widget.
     */
    public function getHtml(): string
    {
        return $this->items['html'];
    }

    /**
     * Width of the widget in logical pixels.
     */
    public function getWidth(): ?int
    {
        return $this->items['width'] ?? null;
    }

    /**
     * Height of the widget in logical pixels.
     */
    public function getHeight(): ?int
    {
        return $this->items['height'] ?? null;
    }

    /**
     * Data shared across all messages displaying this widget.
     */
    public function getPublicData(): ?string
    {
        return $this->items['public_data'] ?? null;
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

    /**
     * Pass True to allow the widget to send queries to the bot.
     */
    public function getAllowQueries(): ?bool
    {
        return $this->items['allow_queries'] ?? null;
    }

    /**
     * Pass True to create a shared widget.
     */
    public function getIsShared(): ?bool
    {
        return $this->items['is_shared'] ?? null;
    }
}
