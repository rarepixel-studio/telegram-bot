<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class RichBlock.
 *
 * Represents a block in a rich formatted message.
 *
 * @link https://core.telegram.org/bots/api#richblock
 */
class RichBlock extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'text' => RichText::class,
            'caption' => RichBlockCaption::class,
            'credit' => RichText::class,
            'summary' => RichText::class,
            'blocks' => self::class,
            'items' => RichBlockListItem::class,
            'cells' => RichBlockTableCell::class,
            'location' => Location::class,
            'animation' => Animation::class,
            'audio' => Audio::class,
            'document' => Document::class,
            'photo' => PhotoSize::class,
            'video' => Video::class,
            'voice_note' => Voice::class,
            'buttons' => RichMessageButton::class,
        ];
    }

    /**
     * Type of the rich block.
     */
    public function getType(): ?string
    {
        return $this->items['type'] ?? null;
    }

    /**
     * (Optional). Rich text used by the block.
     */
    public function getText(): mixed
    {
        return $this->items['text'] ?? null;
    }

    /**
     * (Optional). Nested rich blocks.
     *
     * @return Collection<int, RichBlock>|null
     */
    public function getBlocks(): ?Collection
    {
        return $this->items['blocks'] ?? null;
    }

    /**
     * (Optional). List items.
     *
     * @return Collection<int, RichBlockListItem>|null
     */
    public function getItems(): ?Collection
    {
        return $this->items['items'] ?? null;
    }

    /**
     * (Optional). Table cells.
     *
     * @return Collection<int, Collection<int, RichBlockTableCell>>|null
     */
    public function getCells(): ?Collection
    {
        return $this->items['cells'] ?? null;
    }

    /**
     * (Optional). Caption attached to the block.
     */
    public function getCaption(): ?RichBlockCaption
    {
        return $this->items['caption'] ?? null;
    }

    /**
     * (Optional). Credit attached to the block.
     */
    public function getCredit(): mixed
    {
        return $this->items['credit'] ?? null;
    }

    /**
     * (Optional). Summary text for details blocks.
     */
    public function getSummary(): mixed
    {
        return $this->items['summary'] ?? null;
    }

    /**
     * (Optional). URL attached to the block.
     */
    public function getUrl(): ?string
    {
        return $this->items['url'] ?? null;
    }

    /**
     * (Optional). Location for map blocks.
     */
    public function getLocation(): ?Location
    {
        return $this->items['location'] ?? null;
    }

    /**
     * (Optional). Animation for animation blocks.
     */
    public function getAnimation(): ?Animation
    {
        return $this->items['animation'] ?? null;
    }

    /**
     * (Optional). Audio for audio blocks.
     */
    public function getAudio(): ?Audio
    {
        return $this->items['audio'] ?? null;
    }

    /**
     * (Optional). Photo sizes for photo blocks.
     *
     * @return Collection<int, PhotoSize>|null
     */
    public function getPhoto(): ?Collection
    {
        return $this->items['photo'] ?? null;
    }

    /**
     * (Optional). Video for video blocks.
     */
    public function getVideo(): ?Video
    {
        return $this->items['video'] ?? null;
    }

    /**
     * (Optional). Voice note for voice-note blocks.
     */
    public function getVoiceNote(): ?Voice
    {
        return $this->items['voice_note'] ?? null;
    }

    /**
     * (Optional). Document for document blocks.
     */
    public function getDocument(): ?Document
    {
        return $this->items['document'] ?? null;
    }

    /**
     * (Optional). Buttons for button-row blocks.
     *
     * @return Collection<int, RichMessageButton>|null
     */
    public function getButtons(): ?Collection
    {
        return $this->items['buttons'] ?? null;
    }

    /**
     * (Optional). Horizontal alignment of buttons or table content.
     */
    public function getAlign(): ?string
    {
        return $this->items['align'] ?? null;
    }

    /**
     * (Optional). True if table cells have smaller indents.
     */
    public function getIsCompact(): ?bool
    {
        return $this->items['is_compact'] ?? null;
    }
}
