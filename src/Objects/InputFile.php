<?php

namespace Telegram\Bot\Objects;

/**
 * Class InputFile.
 *
 * This object represents the contents of a file to be uploaded.
 *
 * @link https://core.telegram.org/bots/api#inputfile
 */
class InputFile extends BaseObject
{
    /**
     * {@inheritdoc}
     */
    public function relations(): array
    {
        return [];
    }
}
