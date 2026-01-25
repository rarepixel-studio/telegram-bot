<?php

namespace Telegram\Bot\Objects\InlineQuery;

use Illuminate\Support\Collection;
use Telegram\Bot\Objects\MessageEntity;

/**
 * Class InlineQueryResultAudio.
 *
 * Represents a link to an MP3 audio file.
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultaudio
 */
class InlineQueryResultAudio extends InlineQueryResult
{
    public function __construct($params = [])
    {
        parent::__construct($params);
        $this->put('type', 'audio');
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
     * A valid URL for the audio file.
     */
    public function getAudioUrl(): string
    {
        return $this->items['audio_url'];
    }

    /**
     * Title of the result.
     */
    public function getTitle(): string
    {
        return $this->items['title'];
    }

    /**
     * (Optional). Caption for the audio file.
     */
    public function getCaption(): ?string
    {
        return $this->items['caption'] ?? null;
    }

    /**
     * (Optional). Mode for parsing entities in the audio caption.
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
     * (Optional). Performer of the audio file.
     */
    public function getPerformer(): ?string
    {
        return $this->items['performer'] ?? null;
    }

    /**
     * (Optional). Audio duration in seconds.
     */
    public function getAudioDuration(): ?int
    {
        return $this->items['audio_duration'] ?? null;
    }
}
