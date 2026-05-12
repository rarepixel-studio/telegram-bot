<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class InputPollOption.
 *
 * This object contains information about one answer option in a poll to be sent.
 */
class InputPollOption extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'text_entities' => MessageEntity::class,
            'media' => InputPollOptionMedia::class,
        ];
    }

    /**
     * Option text, 1-100 characters.
     */
    public function getText(): string
    {
        return $this->items['text'];
    }

    /**
     * (Optional). Mode for parsing entities in the text.
     */
    public function getTextParseMode(): ?string
    {
        return $this->items['text_parse_mode'] ?? null;
    }

    /**
     * @return Collection<int, MessageEntity>|null
     */
    public function getTextEntities(): ?Collection
    {
        return $this->items['text_entities'] ?? null;
    }

    /**
     * (Optional). Media added to the poll option.
     */
    public function getMedia(): ?InputPollOptionMedia
    {
        return $this->items['media'] ?? null;
    }
}
