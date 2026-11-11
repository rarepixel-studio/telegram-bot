<?php

namespace Telegram\Bot\Objects;

/**
 * A theme for the screen used to share a chat or user link.
 *
 * @link https://core.telegram.org/bots/api#chatsharetheme
 */
class ChatShareTheme extends BaseObject
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
            'emoji' => new ChatShareThemeEmoji($data),
            'unique_gift' => new ChatShareThemeUniqueGift($data),
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
