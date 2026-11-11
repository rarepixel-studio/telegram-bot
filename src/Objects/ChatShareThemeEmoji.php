<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * A chat share theme with emoji over a backdrop.
 *
 * @link https://core.telegram.org/bots/api#chatsharethemeemoji
 */
class ChatShareThemeEmoji extends ChatShareTheme
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'emojis' => static fn (array $items): Collection => new Collection(array_map(EmojiType::fromArray(...), $items)),
        ];
    }

    /**
     * The regular or custom emoji used by the theme.
     *
     * @return Collection<int, EmojiType>
     */
    public function getEmojis(): Collection
    {
        return $this->items['emojis'];
    }

    /**
     * Identifier of the backdrop used as the background.
     */
    public function getBackgroundBackdropId(): ?int
    {
        return $this->items['background_backdrop_id'] ?? null;
    }
}
