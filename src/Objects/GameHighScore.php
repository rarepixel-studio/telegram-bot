<?php

namespace Telegram\Bot\Objects;

/**
 * Class GameHighScore.
 */
class GameHighScore extends BaseObject
{
    /**
     * Property relations.
     */
    public function relations(): array
    {
        return [
            'user' => User::class,
        ];
    }

    /**
     * Position in high score table for the game.
     */
    public function getPosition(): int
    {
        return $this->items['position'];
    }

    /**
     * User.
     */
    public function getUser(): User
    {
        return $this->items['user'];
    }

    /**
     * Score.
     */
    public function getScore(): int
    {
        return $this->items['score'];
    }
}
