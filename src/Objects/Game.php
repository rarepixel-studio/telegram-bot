<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class Game. *
 */
class Game extends BaseObject
{
    /**
     * Property relations.
     */
    public function relations(): array
    {
        return [
            'photo' => PhotoSize::class,
            'text_entities' => MessageEntity::class,
            'animation' => Animation::class,
        ];
    }

    /**
     * Title of the game.
     */
    public function getTitle(): string
    {
        return $this->items['title'];
    }

    /**
     * Description of the game.
     */
    public function getDescription(): string
    {
        return $this->items['description'];
    }

    /**
     * Photo that will be displayed in the game message in chats.
     */
    /**
     * @return Collection<int, PhotoSize>
     */
    public function getPhoto(): Collection
    {
        return $this->items['photo'];
    }

    /**
     * (Optional). Brief description of the game or high scores included in the game message. Can be automatically edited to include current high scores for the game when the bot calls setGameScore, or manually edited using editMessageText. 0-4096 characters.
     */
    public function getText(): ?string
    {
        return $this->items['text'] ?? null;
    }

    /**
     * @return Collection<int, MessageEntity>|null
     */
    public function getTextEntities(): ?Collection
    {
        return $this->items['text_entities'] ?? null;
    }

    /**
     * @return Collection<int, Animation>|null
     */
    public function getAnimation(): ?Collection
    {
        return $this->items['animation'] ?? null;
    }
}
