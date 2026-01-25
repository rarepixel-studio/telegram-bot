<?php

namespace Telegram\Bot\Objects\InlineQuery;

use Illuminate\Support\Collection;
use Telegram\Bot\Objects\MessageEntity;

/**
 * Class InlineQueryResultCachedVoice.
 *
 * Represents a link to a voice message stored on Telegram servers.
 *
 * @link https://core.telegram.org/bots/api#inlinequeryresultcachedvoice
 */
class InlineQueryResultCachedVoice extends InlineQueryResult
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
     * A valid file identifier for the voice message.
     */
    public function getVoiceFileId(): string
    {
        return $this->items['voice_file_id'];
    }

    /**
     * Title of the result.
     */
    public function getTitle(): string
    {
        return $this->items['title'];
    }

    /**
     * (Optional). Caption for the voice message.
     */
    public function getCaption(): ?string
    {
        return $this->items['caption'] ?? null;
    }

    /**
     * (Optional). Mode for parsing entities in the voice message caption.
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
}
