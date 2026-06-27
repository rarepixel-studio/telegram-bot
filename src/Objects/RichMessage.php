<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class RichMessage.
 *
 * Represents a rich formatted message.
 *
 * @link https://core.telegram.org/bots/api#richmessage
 */
class RichMessage extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [
            'blocks' => RichBlock::class,
        ];
    }

    /**
     * Content of the message.
     *
     * @return Collection<int, RichBlock>
     */
    public function getBlocks(): Collection
    {
        return $this->items['blocks'];
    }

    /**
     * (Optional). True if the rich message must be shown right-to-left.
     */
    public function getIsRtl(): ?bool
    {
        return $this->items['is_rtl'] ?? null;
    }
}
