<?php

namespace Telegram\Bot\Objects;

/**
 * Class InputMediaAudio.
 *
 * Represents an audio file to be treated as music to be sent.
 *
 * @link https://core.telegram.org/bots/api#inputmediaaudio
 */
class InputMediaAudio extends InputMedia
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'caption_entities' => MessageEntity::class,
        ];
    }

    /**
     * Type of the result, must be audio.
     */
    public function getType(): string
    {
        return 'audio';
    }

    /**
     * File to send.
     */
    public function getMedia(): string
    {
        return $this->items['media'];
    }

    /**
     * (Optional). Thumbnail of the file sent.
     */
    public function getThumbnail(): mixed
    {
        return $this->items['thumbnail'] ?? null;
    }

    /**
     * (Optional). Caption of the audio to be sent, 0-1024 characters.
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
     */
    public function getCaptionEntities(): ?array
    {
        return $this->items['caption_entities'] ?? null;
    }

    /**
     * (Optional). Duration of the audio in seconds.
     */
    public function getDuration(): ?int
    {
        return $this->items['duration'] ?? null;
    }

    /**
     * (Optional). Performer of the audio.
     */
    public function getPerformer(): ?string
    {
        return $this->items['performer'] ?? null;
    }

    /**
     * (Optional). Title of the audio.
     */
    public function getTitle(): ?string
    {
        return $this->items['title'] ?? null;
    }
}
