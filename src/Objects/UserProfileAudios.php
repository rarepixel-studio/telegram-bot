<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class UserProfileAudios.
 *
 * Represents a list of profile audios for a user.
 *
 * @link https://core.telegram.org/bots/api#userprofileaudios
 */
class UserProfileAudios extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'audios' => Audio::class,
        ];
    }

    /**
     * Total number of profile audios the target user has.
     */
    public function getTotalCount(): int
    {
        return $this->items['total_count'];
    }

    /**
     * Requested profile audios.
     *
     * @return Collection<int, Audio>
     */
    public function getAudios(): Collection
    {
        return $this->items['audios'];
    }
}
