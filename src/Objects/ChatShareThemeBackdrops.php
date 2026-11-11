<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * The available chat share theme backdrops.
 *
 * @link https://core.telegram.org/bots/api#chatsharethemebackdrops
 */
class ChatShareThemeBackdrops extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'backdrops' => static fn (array $items): Collection => new Collection(array_map(ChatShareThemeBackdrop::fromArray(...), $items)),
        ];
    }

    /**
     * The available theme backdrops.
     *
     * @return Collection<int, ChatShareThemeBackdrop>
     */
    public function getBackdrops(): Collection
    {
        return $this->items['backdrops'];
    }
}
