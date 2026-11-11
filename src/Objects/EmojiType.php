<?php

namespace Telegram\Bot\Objects;

/**
 * A regular or custom emoji.
 *
 * @link https://core.telegram.org/bots/api#emojitype
 */
class EmojiType extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }

    /**
     * Hydrate the variant identified by Telegram.
     *
     * @param  array<string, mixed>  $data  The Telegram object payload
     * @return static The hydrated object
     */
    public static function fromArray(array $data): static
    {
        if (static::class !== self::class) {
            return parent::fromArray($data);
        }

        return match ($data['type'] ?? null) {
            'emoji' => new EmojiTypeEmoji($data),
            'custom_emoji' => new EmojiTypeCustomEmoji($data),
            default => new self($data),
        };
    }

    /**
     * The variant discriminator.
     */
    public function getType(): ?string
    {
        return $this->items['type'] ?? null;
    }
}
