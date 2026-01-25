<?php

namespace Telegram\Bot\Objects\InlineQuery;

use Illuminate\Support\Collection;
use Telegram\Bot\Objects\MessageEntity;

/**
 * Class InlineQueryResultVoice.
 *
 * Represents a link to a voice recording.
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultvoice
 */
class InlineQueryResultVoice extends InlineQueryResult
{
    public function __construct($params = [])
    {
        parent::__construct($params);
        $this->put('type', 'voice');
    }

    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return array_merge(parent::relations(), [
            'caption_entities' => MessageEntity::class,
        ]);
    }

    /**
     * A valid URL for the voice recording.
     */
    public function getVoiceUrl(): string
    {
        return $this->items['voice_url'];
    }

    /**
     * Recording title.
     */
    public function getTitle(): string
    {
        return $this->items['title'];
    }

    /**
     * (Optional). Caption for the recording.
     */
    public function getCaption(): ?string
    {
        return $this->items['caption'] ?? null;
    }

    /**
     * (Optional). Mode for parsing entities in the recording caption.
     */
    public function getParseMode(): ?string
    {
        return $this->items['parse_mode'] ?? null;
    }

    /**
     * (Optional). List of special entities that appear in the caption.
     *
     * @return array<int, MessageEntity>|null
     */
    public function getCaptionEntities(): ?array
    {
        $entities = $this->items['caption_entities'] ?? null;

        if ($entities instanceof Collection) {
            return $entities->all();
        }

        return $entities;
    }

    /**
     * (Optional). Recording duration in seconds.
     */
    public function getVoiceDuration(): ?int
    {
        return $this->items['voice_duration'] ?? null;
    }
}
