<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class TextQuote.
 *
 * This object contains information about the quoted part of a message that is replied to by the given message.
 */
class TextQuote extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'entities' => MessageEntity::class,
        ];
    }

    /**
     * Text of the quoted part of a message that is replied to by the given message.
     */
    public function getText(): string
    {
        return $this->items['text'];
    }

    /**
     * @return Collection<int, MessageEntity>|null
     */
    public function getEntities(): ?Collection
    {
        return $this->items['entities'] ?? null;
    }

    /**
     * Approximate quote position in the original message in UTF-16 code units.
     */
    public function getPosition(): int
    {
        return $this->items['position'];
    }

    /**
     * (Optional). True, if the quote was chosen manually by the message sender.
     */
    public function getIsManual(): ?bool
    {
        return $this->items['is_manual'] ?? null;
    }
}
