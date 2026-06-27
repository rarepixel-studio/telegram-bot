<?php

namespace Telegram\Bot\Objects;

use Illuminate\Support\Collection;

/**
 * Class RichBlockListItem.
 *
 * Represents an item in a rich formatted list.
 *
 * @link https://core.telegram.org/bots/api#richblocklistitem
 */
class RichBlockListItem extends BaseObject
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
     * Blocks contained in the list item.
     *
     * @return Collection<int, RichBlock>
     */
    public function getBlocks(): Collection
    {
        return $this->items['blocks'];
    }
}
