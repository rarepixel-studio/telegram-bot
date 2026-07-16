<?php

namespace Telegram\Bot\Objects;

/**
 * Class InputRichBlock.
 *
 * Base class for all InputRichBlock types.
 *
 * @link https://core.telegram.org/bots/api#inputrichblock
 */
class InputRichBlock extends BaseObject
{
    /**
     * Type of the rich block.
     */
    public function getType(): ?string
    {
        return $this->items['type'] ?? null;
    }

    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}
