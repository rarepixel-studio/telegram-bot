<?php

namespace Telegram\Bot\Objects;

/**
 * Class UniqueGift.
 *
 * Describes a unique gift that was upgraded from a regular gift.
 */
class UniqueGift extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'model' => UniqueGiftModel::class,
            'symbol' => UniqueGiftSymbol::class,
            'backdrop' => UniqueGiftBackdrop::class,
            'publisher_chat' => Chat::class,
        ];
    }

    /**
     * Human-readable name of the regular gift from which this unique gift was upgraded.
     */
    public function getBaseName(): string
    {
        return $this->items['base_name'];
    }

    /**
     * Unique name of the gift. This name can be used in https://t.me/nft/... links and story areas.
     */
    public function getName(): string
    {
        return $this->items['name'];
    }

    /**
     * Unique number of the upgraded gift among gifts upgraded from the same regular gift.
     */
    public function getNumber(): int
    {
        return $this->items['number'];
    }

    /**
     * Model of the gift.
     */
    public function getModel(): UniqueGiftModel
    {
        return $this->items['model'];
    }

    /**
     * Symbol of the gift.
     */
    public function getSymbol(): UniqueGiftSymbol
    {
        return $this->items['symbol'];
    }

    /**
     * Backdrop of the gift.
     */
    public function getBackdrop(): UniqueGiftBackdrop
    {
        return $this->items['backdrop'];
    }

    /**
     * (Optional). Information about the chat that published the gift.
     */
    public function getPublisherChat(): ?Chat
    {
        return $this->items['publisher_chat'] ?? null;
    }
}
