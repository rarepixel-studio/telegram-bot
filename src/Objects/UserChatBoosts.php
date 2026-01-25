<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class UserChatBoosts.
 *
 * This object represents a list of boosts added to a chat by a user.
 *
 * @link https://core.telegram.org/bots/api#userchatboosts
 */
class UserChatBoosts extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'boosts' => ChatBoost::class,
        ];
    }

    /**
     * @return Collection<int, ChatBoost>
     */
    public function getBoosts(): Collection
    {
        return $this->items['boosts'];
    }
}
